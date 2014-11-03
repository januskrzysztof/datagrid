<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class Cell
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Cell {
    /**
     * @var AbstractTag
     */
    private $xhtml;

    /**
     * @var AbstractColumn
     */
    private $column;

    /**
     * @param AbstractTag $xhtml
     * @param AbstractColumn $column
     */
    public function __construct(AbstractTag $xhtml, AbstractColumn $column) {
        $this->xhtml = $xhtml;
        $this->column = $column;
    }

    /**
     * @return AbstractTag
     */
    public function getXhtml() {
        return $this->xhtml;
    }

    /**
     * @param AbstractTag $xhtml
     */
    public function setXhtml($xhtml) {
        $this->xhtml = $xhtml;
    }

    /**
     * @return AbstractColumn
     */
    public function getColumn() {
        return $this->column;
    }

    /**
     * @param AbstractColumn $column
     */
    public function setColumn($column) {
        $this->column = $column;
    }
}