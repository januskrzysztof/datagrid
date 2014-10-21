<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation\Column;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Column as BaseColumn;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;

/**
 * Class Column
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\AnnotationGridBuilder
 *
 * @Annotation
 */
class Column extends ConfigurationAnnotation {
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
    private $staticValue;

    /**
     * @var Attributes
     */
    private $attributes;

    public function __construct(array $values) {
        if (!isset($values['attributes'])) {
            $values['attributes'] = new Attributes([]);
        }

        parent::__construct($values);
    }

    public function getAliasName() {
        return BaseColumn::class;
    }

    public function allowArray() {
        return false;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return Attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param Attributes $attributes
     */
    public function setAttributes(Attributes $attributes) {
        $this->attributes = $attributes;
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
     * @return boolean
     */
    public function isVisible() {
        return $this->isVisible;
    }

    /**
     * @param boolean $isVisible
     */
    public function setIsVisible($isVisible) {
        $this->isVisible = $isVisible;
    }

    /**
     * @return boolean
     */
    public function isSortable() {
        return $this->isSortable;
    }

    /**
     * @param boolean $isSortable
     */
    public function setIsSortable($isSortable) {
        $this->isSortable = $isSortable;
    }

    /**
     * @return string
     */
    public function getStaticValue() {
        return $this->staticValue;
    }

    /**
     * @param string $staticValue
     */
    public function setStaticValue($staticValue) {
        $this->staticValue = $staticValue;
    }
}