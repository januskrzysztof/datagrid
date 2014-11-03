<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\RouteDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\ValueDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\ColumnException;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class RouteColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\Column
 */
class RouteColumn extends AbstractColumn {
    /**
     * @var RouteDefinition;
     */
    private $routeDefinition;

    /**
     * @var RouteDecorator
     */
    private $decorator;

    /**
     * @param string $name
     * @param RouteDefinition $routeDefinition
     * @param array $options
     * @throws ColumnException
     */
    public function __construct($name, RouteDefinition $routeDefinition = null, array $options = []) {
        parent::__construct($name, $options);
        $this->decorator = new RouteDecorator();
        $this->addDecorator(new ValueDecorator());

        if ($routeDefinition !== null) {
            $this->setRouteDefinition($routeDefinition);
        }
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

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        $this->decorator->setRouteDefinition($this->getRouteDefinition());

        return $this->decorator->decorate($event);
    }
}