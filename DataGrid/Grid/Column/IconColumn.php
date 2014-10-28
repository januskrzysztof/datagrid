<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\RouteDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\XhtmlTagDecorator;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class IconColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconsColumn
 */
class IconColumn extends RouteColumn {
    /**
     * @var string
     */
    private $fa;

    /**
     * @param string $name
     * @param array $options
     * @param RouteDefinition $routeDefinition
     */
    public function __construct($name = 'icon', array $options = [], RouteDefinition $routeDefinition = null) {
        parent::__construct($name, $options, $routeDefinition);
    }

    /**
     * @return mixed
     */
    public function getFa() {
        return $this->fa;
    }

    /**
     * @param mixed $fa
     */
    public function setFa($fa) {
        $this->fa = $fa;
    }

    /**
     * @return RouteDecorator
     */
    protected function initDecorator() {
        $attributes = $this->getAttributes();
        $decorator  = new XhtmlTagDecorator('i', ['class' => $this->getFa()]);
        $decorator->addDecorator(new RouteDecorator($this->getRouteDefinition(), $attributes->all()));

        return $decorator;
    }
}