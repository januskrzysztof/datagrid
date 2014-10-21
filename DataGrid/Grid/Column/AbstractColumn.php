<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use BadMethodCallException;
use Tutto\Bundle\DataGridBundle\Exceptions\Decorator\DecoratorException;
use Tutto\Bundle\UtilBundle\Logic\Attributes;

/**
 * Class AbstractColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
abstract class AbstractColumn {
    private $name;

    private $label;

    private $propertyPath;

    private $isVisible = true;

    private $isSortable = false;

    private $decorator;

    private $staticValue;

    private $postAccessValueEvents = [];

    /**
     * @var Attributes
     */
    private $attributes;

    /**
     * @param string $name
     * @param array $options
     */
    public function __construct($name, array $options = []) {
        if (!is_string($name)) {
            throw new DecoratorException('Name must be a string.');
        }
        if (!isset($options['propertyPath'])) {
            $options['propertyPath'] = $name;
        }
        if (!isset($options['label'])) {
            $options['label'] = $name;
        }
        if (!isset($options['attributes'])) {
            $this->attributes = new Attributes();
        } else {
            $attributes = $options['attributes'];
            if (is_array($attributes)) {
                $options['attributes'] = new Attributes($attributes);
            }
        }

        foreach ($options as $key => $value) {
            $setMethod = 'set'.ucfirst($key);
            $addMethod = 'add'.ucfirst($key);

            if (method_exists($this, $setMethod)) {
                $this->$setMethod($value);
            } elseif(method_exists($this, $addMethod)) {
                $this->$addMethod($value);
            } else {
                throw new BadMethodCallException(sprintf("Unknown property '%s'.", $key));
            }
        }
    }

    /**
     * @return AbstractDecorator
     */
    abstract protected function initDecorator();

    /**
     * @param boolean $isVisible
     */
    public function setIsVisible($isVisible) {
        $this->isVisible = (boolean) $isVisible;
    }

    /**
     * @return bool
     */
    public function isVisible() {
        return $this->isVisible;
    }

    /**
     * @param boolean $isSortable
     */
    public function setIsSortable($isSortable) {
        $this->isSortable = (boolean) $isSortable;
    }

    /**
     * @return bool
     */
    public function getIsSortable() {
        return $this->isSortable;
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
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getStaticValue() {
        return $this->staticValue;
    }

    /**
     * @param mixed $staticValue
     */
    public function setStaticValue($staticValue) {
        $this->staticValue = $staticValue;
    }

    /**
     * @return string
     */
    public function getPropertyPath() {
        return $this->propertyPath;
    }

    /**
     * @param string $propertyPath
     */
    public function setPropertyPath($propertyPath) {
        $this->propertyPath = $propertyPath;
    }

    /**
     * @return AbstractDecorator
     */
    public function getDecorator() {
        if ($this->decorator === null) {
            $this->decorator = $this->initDecorator();
        }

        return $this->decorator;
    }

    /**
     * @param AbstractDecorator $decorator
     * @param string $placement
     */
    public function addDecorator(AbstractDecorator $decorator, $placement = AbstractDecorator::PREPEND) {
        $this->getDecorator()->addDecorator($decorator, $placement);
    }

    /**
     * @param callable $callable
     */
    public function addPostAccessValueEvent($callable) {
        $this->postAccessValueEvents[] = $callable;
    }

    /**
     * @return array
     */
    public function getPostAccessValueEvents() {
        return $this->postAccessValueEvents;
    }

    public function setAttributes(Attributes $attributes) {
        $this->attributes = $attributes;
    }

    public function getAttributes() {
        return $this->attributes;
    }
}