<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class CallableDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator
 */
class CallableDecorator extends AbstractDecorator {
    /**
     * @var callable
     */
    private $callable;

    /**
     * @param callable $callable
     * @param int $placement
     */
    function __construct($callable, $placement = self::APPEND) {
        parent::__construct($placement);
        $this->callable = $callable;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return call_user_func_array($this->callable, [$event]);
    }
}