<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

/**
 * Interface GridInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
interface GridInterface {
    /**
     * @param GridBuilder $builder
     */
    public function appendSettings(GridBuilder $builder);
}