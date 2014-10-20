<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

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