<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;

/**
 * Class AbstractColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class AbstractColumn {
    private $name;

    private $label;

    private $propertyPath;

    private $isVisible = true;

    private $isSotrable = false;

    private $decorator;

    private $staticValue;

    private $postAccessValueEvents = [];

    /**
     * @param AbstractDecorator $decorator
     * @param string $name
     * @param null $label
     * @param null $propertyPath
     */
    public function __construct(AbstractDecorator $decorator, $name, $label = null, $propertyPath = null) {
        if ($label === null) {
            $label = $name;
        }
        if ($propertyPath === null) {
            $propertyPath = $name;
        }

        $this->name         = $name;
        $this->label        = $label;
        $this->propertyPath = $propertyPath;
        $this->decorator    = $decorator;
    }

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
     * @param boolean $isSotrable
     */
    public function setIsSotrable($isSotrable) {
        $this->isSotrable = (boolean) $isSotrable;
    }

    /**
     * @return bool
     */
    public function getIsSortable() {
        return $this->isSotrable;
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
        return $this->decorator;
    }

    /**
     * @param AbstractDecorator $decorator
     * @param string $placement
     */
    public function addDecorator(AbstractDecorator $decorator, $placement = AbstractDecorator::PREPEND) {
        $this->decorator->addDecorator($decorator, $placement);
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
}