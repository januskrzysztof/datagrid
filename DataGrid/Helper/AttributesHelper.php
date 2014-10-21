<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

/**
 * Class AttributesHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class AttributesHelper implements HelperInterface {
    public function init() {
        return $this;
    }

    /**
     * @return string Helper name
     */
    public function getName() {
        return 'attributes';
    }

    /**
     * @return string|array Helper callable
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}