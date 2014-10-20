<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

/**
 * Interface HelperInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
interface HelperInterface {
    /**
     * @return string Helper name
     */
    public function getName();

    /**
     * @return string|array Helper callable
     */
    public function getCallable();
}