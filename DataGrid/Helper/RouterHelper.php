<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\DataGridFactory;
use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;

/**
 * Class RouterHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class RouterHelper implements HelperInterface {
    const SORT_NAME  = DataGridFactory::SORT_NAME;
    const ORDER_NAME = DataGridFactory::ORDER_NAME;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Router $router
     * @param Request $request
     */
    public function __construct(Router $router, Request $request) {
        $this->router  = $router;
        $this->request = $request;
    }

    /**
     * @return $this
     */
    public function init() {
        return $this;
    }

    /**
     * @param array $parameters
     * @param null $name
     * @param bool $referenceType
     * @return string
     */
    public function generate(array $parameters = [], $name = null, $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH ) {
        $parameters = array_merge(
            $this->request->get('_route_params'),
            $parameters
        );

        if ($name === null) {
            $name = $this->request->get('_route');
        }

        if (isset($parameters[self::SORT_NAME])) {
            if ($parameters[self::SORT_NAME] === $this->request->get(self::SORT_NAME)) {
                $parameters[self::ORDER_NAME] = $this->request->get(self::ORDER_NAME) === DataProviderInterface::ASC ? DataProviderInterface::DESC : DataProviderInterface::ASC;
            } else {
                $parameters[self::ORDER_NAME] = DataProviderInterface::DESC;
            }
        }

        return $this->router->generate($name, $parameters, $referenceType);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'router';
    }

    /**
     * @return array
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}