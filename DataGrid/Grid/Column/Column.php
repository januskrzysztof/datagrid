<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;

/**
 * Class Column
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class Column extends AbstractColumn {
    /**
     * @param string $name
     */
    public function __construct($name) {
        parent::__construct(new ValueDecorator(), $name);
    }

}