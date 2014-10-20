<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

/**
 * Class Event
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Event {
    private $data;
    private $value;

    public function __construct($data, $value) {
        $this->setData($data);
        $this->setValue($value);
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
}