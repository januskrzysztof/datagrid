<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

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
     * @param mixed $value
     * @return AbstractTag
     */
    abstract public function decorate($value = null);

    /**
     * @param AbstractDecorator $decorator
     * @param string $placement
     */
    public function addDecorator(AbstractDecorator $decorator, $placement = self::APPEND) {
        $this->decorators[] = [$placement, $decorator];
    }

    /**
     * @return array
     */
    public function getDecorators() {
        return $this->decorators;
    }
}