<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconColumn;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class DeleteColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon
 */
class DeleteColumn extends IconColumn {
    /**
     * @param RouteDefinition $routeDefinition
     * @param array $options
     */
    public function __construct(RouteDefinition $routeDefinition = null, array $options = []) {
        $options['fa'] = 'fa-times fa fa-white';
        parent::__construct('delete', $routeDefinition, $options);
    }
}