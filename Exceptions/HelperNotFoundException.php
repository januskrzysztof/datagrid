<?php

namespace Tutto\Bundle\DataGridBundle\Exceptions;

use Exception;

/**
 * Class HelperNotFoundException
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Exception
 */
class HelperNotFoundException extends Exception {
    /**
     * @param string $helperName
     */
    public function __construct($helperName) {
        parent::__construct("Helper: '{$helperName}' not found.");
    }
}