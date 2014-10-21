<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class Row
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Row {
    private $cells = [];

    public function addCell(Cell $cell) {
        $this->cells[] = $cell;
    }

    public function getCells() {
        return $this->cells;
    }
}