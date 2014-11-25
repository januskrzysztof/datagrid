<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Cell;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Row;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\FormHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\PaginationHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\RouterHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Attributes;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\AbstractGridBuilder;

use BadMethodCallException;

/**
 * Class DataGridFactory
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
class DataGridFactory {
    const SORT_NAME  = '_sort';
    const PAGE_NAME  = '_page';
    const ORDER_NAME = '_order';
    const LIMIT_NAME = '_limit';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var DataGrid
     */
    private $dataGrid;

    /**
     * @var TimedTwigEngine
     */
    private $templating;

    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @var FormFactory
     */
    private $formFactory;

    /**
     * @var array
     */
    private $config = [];

    /**
     * @param DataGrid $dataGrid
     * @param TwigEngine $templating
     * @param PropertyAccessorInterface $propertyAccessor
     * @param ContainerInterface $container
     */
    function __construct(DataGrid $dataGrid, TwigEngine $templating, FormFactory $formFactory, PropertyAccessorInterface $propertyAccessor,  ContainerInterface $container) {
        $this->dataGrid         = $dataGrid;
        $this->container        = $container;
        $this->config           = $container->getParameter('tutto_data_grid');
        $this->templating       = $templating;
        $this->formFactory      = $formFactory;
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param AbstractGridBuilder $gridBuilder
     * @param DataProviderInterface $dataProvider
     * @param AbstractFiltersType $filters
     * @param Request $request
     * @param bool $template
     * @return array
     */
    public function createResponse(AbstractGridBuilder $gridBuilder, DataProviderInterface $dataProvider, AbstractFiltersType $filters, Request $request = null, $template = false) {
        /** Set request if not passed */
        if ($request === null) {
            $request = $this->container->get('request');
        }

        /** @var Session $session */
        $session = $request->getSession();

        $gridBuilder->setContainer($this->container);
        $gridBuilder->build();

        foreach ($gridBuilder->getColumns() as $column) {
            $this->dataGrid->addColumn($column);
        }

        $dataProvider->setLimit($request->get(self::LIMIT_NAME, 30));
        $dataProvider->setPage($request->get(self::PAGE_NAME, 1));
        $dataProvider->setSort($request->get(self::SORT_NAME, DataProviderInterface::SORT));
        $dataProvider->setOrder($request->get(self::ORDER_NAME, DataProviderInterface::DESC));

        if ($session->has($filters->getName())) {
            $data = $session->get($filters->getName());
        } else {
            $data = null;
        }

        $showResultsMode = $gridBuilder->getAttributes()->getShowResultsMode();

        /** Set filter data from $_POST or if exists from $_SESSION */
        $form = $this->formFactory->create($filters, $data);
        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                if ($form->get('_clear')->isClicked()) {
                    $session->remove($filters->getName());
                    $form = $this->formFactory->create($filters, $data);
                } else {
                    $showResultsMode = Attributes::SHOW_RESULTS_MODE_ALWAYS;
                    $session->set($filters->getName(), $form->getData());
                }
            } else {
                /* todo dodać flashbag messages jeśli formularz nie jest poprawny. */
            }
        } elseif ($session->has($filters->getName())) {
            $showResultsMode = Attributes::SHOW_RESULTS_MODE_ALWAYS;
        }

        $dataProvider->setFilterData($form->getData());

        /** Prepare results */
        if ($showResultsMode === Attributes::SHOW_RESULTS_MODE_ALWAYS) {
            foreach ($dataProvider->getResult() as $result) {
                $row = new Row();
                foreach ($gridBuilder->getColumns() as $column) {
                    /** Get value from results by property path */
                    $value = $this->getValue($this->propertyAccessor, $column, $result);
                    $event = new Event($value, $result, $column);

                    $this->callPostAccessValueEvents($column, $event);

                    $row->addCell(new Cell($this->decorate($column, $event), $column));
                }
                $this->dataGrid->addRow($row);
            }
        }

        /** Adds helpers */
        $this->dataGrid->addHelper(new PaginationHelper($dataProvider));
        $this->dataGrid->addHelper(new RouterHelper($this->container->get('router'), $request));
        $this->dataGrid->addHelper(new FormHelper($form));
        $this->dataGrid->setGridBuilder($gridBuilder);

        if ($template === false) {
            $template = $this->config['template'];
        }

        return $this->templating->renderResponse($template, [
            'datagrid' => $this->dataGrid,
            'request'  => $request
        ]);
    }

    public function createResponseForObjectBuilder(ObjectsBuilderInterface $builder, Request $request = null, $template = null) {
        return $this->createResponse(
            $builder->getGridBuilder(),
            $builder->getDataProvider(),
            $builder->getFiltersType(),
            $request,
            $template
        );
    }

    private function decorate(AbstractDecorator $decorator, Event $event) {
        $xhtml = $decorator->decorate($event);
        foreach ($decorator->getDecorators() as $subDecorator) {
            if ($subDecorator->getPlacement() === AbstractDecorator::APPEND) {
                $xhtml->addChild($this->decorate($subDecorator, $event));
            } elseif($subDecorator->getPlacement() === AbstractDecorator::PREPEND) {
                $tmp = $xhtml;
                $xhtml = $this->decorate($subDecorator, $event);
                $xhtml->addChild($tmp);
            }
        }

        return $xhtml;
    }

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     * @param AbstractColumn $column
     * @param mixed $result
     * @return mixed
     */
    private function getValue(PropertyAccessorInterface $propertyAccessor, AbstractColumn $column, $result) {
        $propertyPath = $column->getPropertyPath();
        if ($propertyPath === false) {
            return null;
        } elseif ($propertyPath !== false && $propertyPath !== null) {
            return $propertyAccessor->getValue($result, $propertyPath);
        } else {
            throw new InvalidPropertyPathException("Property must be setted for column: '{$column->getName()}'");
        }
    }

    /**
     * @param AbstractColumn $column
     * @param Event $event
     */
    private function callPostAccessValueEvents(AbstractColumn $column, Event $event) {
        foreach ($column->getPostAccessValueEvents() as $callable) {
            if (is_callable($callable)) {
                call_user_func_array($callable, [$event]);
            } else {
                throw new BadMethodCallException();
            }
        }

    }
}