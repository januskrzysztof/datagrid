<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\AbstractDataProvider;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\AbstractGridBuilder;

/**
 * Interface ObjectsBuilderInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
interface ObjectsBuilderInterface {
    /**
     * @return AbstractDataProvider
     */
    public function getDataProvider();

    /**
     * @return AbstractGridBuilder
     */
    public function getGridBuilder();

    /**
     * @return AbstractFiltersType
     */
    public function getFiltersType();
}