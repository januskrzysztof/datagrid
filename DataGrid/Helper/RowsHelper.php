<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Row;

/**
 * Class RowsHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class RowsHelper implements HelperInterface {
    /**
     * @var []
     */
    private $rows = [];

    /**
     * @return $this
     */
    public function init() {
        return $this;
    }

    /**
     * @param Row $row
     */
    public function addRow(Row $row) {
        $this->rows[] = $row;
    }

    /**
     * @return array
     */
    public function getRows() {
        return $this->rows;
    }

    public function clearRows() {
        $this->rows = [];
    }

    /**
     * @return string
     */
    public function getName() {
        return 'rows';
    }

    /**
     * @return array
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}