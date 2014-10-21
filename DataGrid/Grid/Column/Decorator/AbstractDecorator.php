<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class AbstractDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
abstract class AbstractDecorator {
    const PREPEND = 'prepend';
    const APPEND  = 'append';

    /**
     * @var array
     */
    protected $decorators = [];

    /**
     * @param array $decorators
     */
    public function __construct(array $decorators = []) {
        foreach ($decorators as list($decorator, $placement)) {
            $this->addDecorator($decorator, $placement);
        }
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    abstract public function decorate(Event $event);

    /**
     * @param AbstractDecorator $decorator
     * @param string $placement
     */
    public function addDecorator(AbstractDecorator $decorator, $placement = self::PREPEND) {
        $this->decorators[] = [$placement, $decorator];
    }

    /**
     * @return array
     */
    public function getDecorators() {
        return $this->decorators;
    }
}