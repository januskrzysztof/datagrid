<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\AbstractGridBuilder;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Row;
use Tutto\Bundle\DataGridBundle\Exceptions\HelperNotFoundException;
use Tutto\Bundle\DataGridBundle\DataGrid\Helper\HelperInterface;

/**
 * Class DataGrid
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
class DataGrid {
    /**
     * @var array
     */
    private $helpers = [];

    /**
     * @var Row[]
     */
    private $rows = [];

    /**
     * @var AbstractColumn[]
     */
    private $columns = [];

    /**
     * @var AbstractGridBuilder
     */
    private $gridBuilder;

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
     * @return AbstractGridBuilder
     */
    public function getGridBuilder() {
        return $this->gridBuilder;
    }

    /**
     * @param AbstractGridBuilder $gridBuilder
     */
    public function setGridBuilder($gridBuilder) {
        $this->gridBuilder = $gridBuilder;
    }

    /**
     * @return AbstractColumn[]
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * @param string|HelperInterface $name
     * @param null|callable $helper
     * @throws HelperNotFoundException
     */
    public function addHelper($name, $helper = null) {
        if ($name instanceof HelperInterface) {
            $helper = $name;
            $this->helpers[$helper->getName()] = $helper->getCallable();
        } elseif (is_callable($helper) && is_string($name)) {
            $this->helpers[$name] = $helper;
        } else {
            throw new HelperNotFoundException("Helper is not valid.");
        }
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws HelperNotFoundException
     */
    public function __call($name, $arguments = []) {
        return $this->callHelper($name, $arguments);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws HelperNotFoundException
     */
    function __get($name) {
        return $this->callHelper($name, []);
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws HelperNotFoundException
     */
    public function callHelper($name, $arguments = []) {
        if (array_key_exists($name, $this->helpers)) {
            return call_user_func_array($this->helpers[$name], (array) $arguments);
        } else {
            throw new HelperNotFoundException($name);
        }
    }

    /**
     * @return array
     */
    public function getHelpers() {
        return $this->helpers;
    }
}