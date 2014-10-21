<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class XhtmlTagDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class XhtmlTagDecorator extends AbstractDecorator {
    /**
     * @var string
     */
    private $tag;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $children = [];

    /**
     * @param string $tag
     * @param array $attributes
     * @param array $children
     * @param array $decorators
     */
    public function __construct($tag, array $attributes = [], array $children = [], array $decorators = []) {
        parent::__construct($decorators);
        $this->tag        = $tag;
        $this->attributes = $attributes;
        $this->children   = $children;
    }


    /**
     * @param Event $event
     * @return Tag
     */
    public function decorate(Event $event) {
        if ($event->hasAttribute('children')) {
            $children = array_merge(
                $event->getAttributes('children'),
                $this->children
            );
            $event->removeAttribute('children');
        } else {
            $children = $this->children;
        }

        $attributes = array_merge(
            $event->getAttributes(),
            $this->attributes
        );

        return new Tag($this->tag, $attributes, $children);
    }

    /**
     * @return string
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag) {
        $this->tag = $tag;
    }

    /**
     * @return array
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param array $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }
}