<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\Helper\HelperInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;

/**
 * Class GridBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid
 */
class GridBuilder {
    /**
     * @var AbstractColumn[]
     */
    private $columns = [];

    /**
     * @var Row[]
     */
    private $rows;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param Row $row
     */
    public function addRow(Row $row) {
        $this->rows[] = $row;
    }

    /**
     * @return Row[]
     */
    public function getRows() {
        return $this->rows;
    }

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
     * @param string $name
     * @param mixed $value
     */
    public function addAttribute($name, $value) {
        $this->attributes[$name][] = $value;
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
     * @param null|mixed $default
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
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->container;
    }
}