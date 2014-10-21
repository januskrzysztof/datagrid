<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\RouteColumn as BaseRouteColumn;

/**
 * Class RouteColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation
 *
 * @Annotation()
 */
class RouteColumn extends Column {
    private $routeDefinition;

    public function __construct() {

    }

    /**
     * @return mixed
     */
    public function getAliasName() {
        return BaseRouteColumn::class;
    }
}