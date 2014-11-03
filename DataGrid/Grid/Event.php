<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;

/**
 * Class Event
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Event {
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var AbstractColumn
     */
    private $column;

    /**
     * @param mixed $value
     * @param mixed $data
     * @param AbstractColumn $column
     */
    public function __construct($value, $data, AbstractColumn $column) {
        $this->value  = $value;
        $this->data   = $data;
        $this->column = $column;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data) {
        $this->data = $data;
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
    public function setColumn(AbstractColumn $column) {
        $this->column = $column;
    }
}