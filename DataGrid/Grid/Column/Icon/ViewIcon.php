<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\IconColumn;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class ViewIcon
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Icon
 */
class ViewIcon extends IconColumn {
    /**
     * @param RouteDefinition $routeDefinition
     * @param array $options
     */
    public function __construct(RouteDefinition $routeDefinition = null, array $options = []) {
        $options['fa'] = 'fa-share fa fa-white';
        parent::__construct('view', $routeDefinition, $options);
    }
}