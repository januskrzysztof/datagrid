<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconsColumn\Bootstrap;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconColumn;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class EditIcon
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconsColumn
 */
class EditIcon extends IconColumn {
    public function __construct($name = 'edit', array $options = [], RouteDefinition $routeDefinition = null) {
        $options['fa'] = 'fa fa-edit';
        parent::__construct($name, $options, $routeDefinition);

        $this->getAttributes()->set('class', 'btn btn-xs btn-blue tooltips');
        $this->getAttributes()->set('data-placement', 'top');
        $this->getAttributes()->set('data-original-title', $name);
    }

    public function getRouteDefinition() {
        $routeDefinition = parent::getRouteDefinition();
        if ($routeDefinition !== null) {
            $routeDefinition->setRouteName($routeDefinition->getRouteName().'_edit');
        }

        return $routeDefinition;
    }


}