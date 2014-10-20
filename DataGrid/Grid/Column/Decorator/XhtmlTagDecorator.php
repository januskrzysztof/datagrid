<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class XhtmlTagDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class XhtmlTagDecorator extends AbstractDecorator {
    private $tag;
    private $attributes = [];
    private $children = [];

    /**
     * @param array $tag
     * @param array $decorators
     */
    public function __construct($tag, array $attributes = [], array $children = [], array $decorators = []) {
        parent::__construct($decorators);
        $this->tag        = $tag;
        $this->attributes = $attributes;
        $this->children   = $children;
    }

    /**
     * @param mixed $value
     * @return Tag
     */
    public function decorate($value = null) {
        return new Tag($this->tag, $this->attributes, $this->children);
    }
}