<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\DataGridBundle\Exceptions\Decorator\CallableException;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class CallableDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class CallableDecorator extends AbstractDecorator {
    /**
     * @var callable
     */
    private $callable;

    /**
     * @param callable $callable
     * @throws CallableException
     */
    public function __construct($callable, array $decorators = []) {
        parent::__construct($decorators);
        if (is_callable($callable)) {
            $this->callable = $callable;
        } else {
            throw new CallableException("is not callable");
        }
    }

    /**
     * @param mixed $value
     * @return AbstractTag
     */
    public function decorate($value = null) {
        return call_user_func_array($this->callable, [$value]);
    }
}