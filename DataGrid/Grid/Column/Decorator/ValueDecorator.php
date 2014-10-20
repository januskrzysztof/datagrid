<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class ValueDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class ValueDecorator extends AbstractDecorator {
    /**
     * @param mixed $value
     * @return AbstractTag
     */
    public function decorate($value = null) {
        return new Text($value);
    }
}