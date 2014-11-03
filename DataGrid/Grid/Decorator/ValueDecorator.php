<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class ValueDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator
 */
class ValueDecorator extends AbstractDecorator {
    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return new Text($event->getValue());
    }
}