<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;

/**
 * Class ColumnsHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class ColumnsHelper implements HelperInterface {
    /**
     * @var AbstractColumn[]
     */
    private $columns = [];

    /**
     * @param AbstractColumn $column
     */
    public function addColumn(AbstractColumn $column) {
        $this->columns[] = $column;
    }

    /**
     * @return AbstractColumn[]
     */
    public function getColumns() {
       return $this->columns;
    }

    /**
     * @return $this
     */
    public function init() {
        return $this;
    }

    /**
     * @return string Helper name
     */
    public function getName() {
        return 'columns';
    }

    /**
     * @return string|array Helper callable
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}