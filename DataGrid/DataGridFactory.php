<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Dump\Container;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Row;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\FormHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\LabelsHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\PaginationHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\RouterHelper;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\RowsHelper;
use Tutto\Bundle\UtilBundle\Logic\PropertyAccessor;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use BadMethodCallException;

/**
 * Class DataGridFactory
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
class DataGridFactory {
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
     * @param GridInterface $grid
     * @param DataProviderInterface $dataProvider
     * @param AbstractFiltersType $filters
     * @param Request $request
     * @param bool $template
     * @return array
     */
    public function createResponse(GridInterface $grid, DataProviderInterface $dataProvider, AbstractFiltersType $filters, Request $request = null, $template = false) {
        /** Set request if not passed */
        if ($request === null) {
            $request = $this->container->get('request');
        }

        /** @var Session $session */
        $session = $request->getSession();

        /** Prepare grid definition */
        $gridBuilder = new GridBuilder($this->container);
        $grid->appendSettings($gridBuilder);

        /** Set grid labels to helper */
        foreach ($gridBuilder->getColumns() as $column) {
            $this->dataGrid->labels->addLabel($column->getLabel());
        }

        $dataProvider->setLimit($request->get('limit', 30));
        $dataProvider->setPage($request->get('page', 1));
        $dataProvider->setSort($request->get('sort', DataProviderInterface::SORT));
        $dataProvider->setOrder($request->get('order', DataProviderInterface::DESC));

        if ($session->has($filters->getName())) {
            $data = $session->get($filters->getName());
        } else {
            $data = null;
        }

        /** Set filter data from $_POST or if exists from $_SESSION */
        $form = $this->formFactory->create($filters, $data);
        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                $session->set($filters->getName(), $form->getData());
            } else {
                /* todo dodać flashbag messages jeśli formularz nie jest poprawny. */
            }
        }

        $dataProvider->setFilterData($form->getData());

        /** Prepare results */
        if ($dataProvider->count() > 0) {
            foreach ($dataProvider->getResult() as $result) {
                $row = new Row();
                foreach ($gridBuilder->getColumns() as $column) {
                    /** Get value from reult by property path */
                    $value = $this->getValue($this->propertyAccessor, $column, $result);
                    $event = new Event($result, $value);

                    $this->callPostAccessValueEvents($column, $event);

                    $row->addCell($this->decorate($column->getDecorator(), $event->getValue()));
                }
                $this->dataGrid->rows->addRow($row);
            }
        }

        /** Adds helpers */
        $this->dataGrid->addHelper(new PaginationHelper($dataProvider));
        $this->dataGrid->addHelper(new RouterHelper($this->container->get('router'), $request));
        $this->dataGrid->addHelper(new FormHelper($form));

        if ($template === false) {
            $template = $this->config['template'];
        }

        return $this->templating->renderResponse($template, [
            'datagrid' => $this->dataGrid,
            'request'  => $request
        ]);
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
            return $column->getStaticValue();
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

    /**
     * @param AbstractDecorator $decorator
     * @param null|mixed $value
     * @return AbstractTag
     */
    private function decorate(AbstractDecorator $decorator, $value = null) {
        $xhtml = $decorator->decorate($value);

        /**
         * @var string $placement
         * @var AbstractDecorator $subDecorator
         */
        foreach ($decorator->getDecorators() as list($placement, $subDecorator)) {
            if ($placement === AbstractDecorator::APPEND) {
                $xhtml->addChild($this->decorate($subDecorator, $value));
            } elseif ($placement === AbstractDecorator::PREPEND) {
                $tmp = $xhtml;
                $xhtml = $this->decorate($subDecorator, $value);
                $xhtml->addChild($tmp);
            }
        }

        return $xhtml;
    }
}