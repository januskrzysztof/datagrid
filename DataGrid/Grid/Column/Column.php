<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;

/**
 * Class Column
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class Column extends AbstractColumn {
    /**
     * @return ValueDecorator
     */
    protected function initDecorator() {
        return new ValueDecorator();
    }
}