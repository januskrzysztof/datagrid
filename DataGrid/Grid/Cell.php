<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class Cell
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Cell {
    protected $xhtml;

    public function getXhtml() {
        return $this->xhtml;
    }

    public function setXhtml(AbstractTag $tag) {
        $this->xhtml = $tag;
    }
}