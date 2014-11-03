<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;
use Tutto\Bundle\UtilBundle\Logic\Attributes as BaseAttributes;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;

/**
 * Class XhtmlDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator
 */
class XhtmlDecorator extends AbstractDecorator {
    /**
     * @var string
     */
    private $name;

    /**
     * @var array|Attributes|BaseAttributes
     */
    private $attributes = [];

    /**
     * @var array
     */
    private $children = [];

    /**
     * @param string $name
     * @param array|Attributes|BaseAttributes $attributes
     * @param array $children
     * @param int $placement
     */
    public function __construct($name, $attributes = [], array $children = [], $placement = self::APPEND) {
        parent::__construct($placement);
        $this->name       = $name;
        $this->attributes = $attributes;
        $this->children   = $children;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return new Tag($this->name, $this->attributes, $this->children);
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return array|BaseAttributes|Attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param array|BaseAttributes|Attributes $attributes
     */
    public function setAttributes($attributes) {
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