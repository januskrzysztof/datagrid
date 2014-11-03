<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

/**
 * Class Row
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Row {
    /**
     * @var Cell[]
     */
    private $cells = [];

    /**
     * @param Cell $cell
     */
    public function addCell(Cell $cell) {
        $this->cells[] = $cell;
    }

    /**
     * @return Cell[]
     */
    public function getCells() {
        return $this->cells;
    }
}