<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class ValueDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class ValueDecorator extends AbstractDecorator {
    /**
     * @param Event $event
     * @return Text
     */
    public function decorate(Event $event) {
        return new Text($event->getValue());
    }
}