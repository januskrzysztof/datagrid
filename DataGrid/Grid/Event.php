<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

/**
 * Class Event
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class Event {
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @param $data
     * @param $value
     * @param array $attributes
     */
    public function __construct($data, $value, array $attributes = []) {
        $this->setData($data);
        $this->setValue($value);

        foreach ($attributes as $name => $val) {
            $this->addAttribute($name, $val);
        }

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

    public function clearAttributes() {
        $this->attributes = [];
    }

    /**
     * @param string $name
     */
    public function removeAttribute($name) {
        if ($this->hasAttribute($name)) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name) {
        return isset($this->attributes[$name]);
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function getAttribute($name, $default = null) {
        return $this->hasAttribute($name) ? $this->attributes[$name] : $default;
    }

    /**
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function addAttribute($name, $value) {
        $this->attributes[$name][] = $value;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setAttribute($name, $value) {
        $this->removeAttribute($name);
        $this->addAttribute($name, $value);
    }
}