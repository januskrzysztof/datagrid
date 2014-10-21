<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class Cell
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Cell {
    protected $xhtml;

    protected $column;

    public function __construct(AbstractTag $xhtml, AbstractColumn $column) {
        $this->xhtml = $xhtml;
        $this->column = $column;
    }

    /**
     * @return mixed
     */
    public function getColumn() {
        return $this->column;
    }

    /**
     * @param mixed $column
     */
    public function setColumn($column) {
        $this->column = $column;
    }

    public function getXhtml() {
        return $this->xhtml;
    }

    public function setXhtml(AbstractTag $tag) {
        $this->xhtml = $tag;
    }
}