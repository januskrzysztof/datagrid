<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\RouteDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class RouteColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class RouteColumn extends AbstractColumn {
    /**
     * @var RouteDefinition
     */
    private $routeDefinition;

    /**
     * @param string $name
     * @param array $options
     * @param RouteDefinition $routeDefinition
     */
    public function __construct($name, array $options = [], RouteDefinition $routeDefinition = null) {
        parent::__construct($name, $options);
        $this->routeDefinition = $routeDefinition;
    }

    /**
     * @return RouteDecorator
     */
    protected function initDecorator() {
        $decorator = new RouteDecorator($this->getRouteDefinition());
        $decorator->addDecorator(new ValueDecorator(), AbstractDecorator::APPEND);

        return $decorator;
    }

    /**
     * @return RouteDefinition
     */
    public function getRouteDefinition() {
        return $this->routeDefinition;
    }

    /**
     * @param RouteDefinition $routeDefinition
     */
    public function setRouteDefinition(RouteDefinition $routeDefinition) {
        $this->routeDefinition = $routeDefinition;
    }
}