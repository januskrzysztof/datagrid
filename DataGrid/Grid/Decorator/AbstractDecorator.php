<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\DecoratorException;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class AbstractDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator
 */
abstract class AbstractDecorator {
    const APPEND  = 1;
    const PREPEND = 0;

    /**
     * @var AbstractDecorator[]
     */
    private $decorators = [];

    /**
     * @var int
     */
    private $placement = self::APPEND;

    public function __construct($placement = self::APPEND) {
        $this->placement = $placement;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    abstract public function decorate(Event $event);

    /**
     * @return int
     */
    public function getPlacement() {
        return $this->placement;
    }

    /**
     * @param int $placement
     * @throws DecoratorException
     */
    public function setPlacement($placement = self::APPEND) {
        if (!in_array($placement, [self::APPEND, self::PREPEND])) {
            throw new DecoratorException("Available placements: ['".self::APPEND."', '".self::PREPEND."'], but setted: '{$placement}'");
        }

        $this->placement = $placement;
    }

    /**
     * @param AbstractDecorator $decorator
     */
    public function addDecorator(AbstractDecorator $decorator) {
        $this->decorators[] = $decorator;
    }

    /**
     * Clear all decorators
     */
    public function clearDecorators() {
        $this->decorators = [];
    }

    /**
     * @return AbstractDecorator[]
     */
    public function getDecorators() {
        return $this->decorators;
    }
}