<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconColumn;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class EditIcon
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon
 */
class EditIcon extends IconColumn {
    /**
     * @param RouteDefinition $routeDefinition
     * @param array $options
     */
    public function __construct(RouteDefinition $routeDefinition = null, array $options = []) {
        $options['fa'] = 'fa fa-edit';
        parent::__construct('edit', $routeDefinition, $options);
    }
}