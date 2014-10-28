<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;
use Tutto\Bundle\DataGridBundle\Exceptions\Decorator\DecoratorException;
use Tutto\Bundle\UtilBundle\Logic\Attributes;
use BadMethodCallException;

/**
 * Class AbstractColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
abstract class AbstractColumn {
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $propertyPath;

    /**
     * @var bool
     */
    private $isVisible = true;

    /**
     * @var bool
     */
    private $isSortable = false;

    /**
     * @var string
     */
    private $sort = DataProviderInterface::SORT;

    private $decorator;

    /**
     * @var mixed
     */
    private $staticValue;

    /**
     * @var array
     */
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
        if (!isset($options['sort'])) {
            $options['sort'] = $options['propertyPath'];
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
     * @param null|string $sort
     */
    public function setIsSortable($isSortable, $sort = null) {
        $this->isSortable = (boolean) $isSortable;

        if ($sort === null) {
            $sort = $this->getName();
        }

        $this->setSort($sort);
    }

    /**
     * @return string
     */
    public function getSort() {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort) {
        $this->sort = $sort;
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

    /**
     * @param Attributes $attributes
     */
    public function setAttributes(Attributes $attributes) {
        $this->attributes = $attributes;
    }

    /**
     * @return Attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }
}