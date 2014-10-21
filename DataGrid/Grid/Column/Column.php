<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;

/**
 * Class Column
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class Column extends AbstractColumn {
    protected function initDecorator() {
        return new ValueDecorator();
    }
}