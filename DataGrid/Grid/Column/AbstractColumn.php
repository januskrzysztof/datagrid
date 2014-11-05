<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\Exceptions\ColumnException;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;
use Tutto\Bundle\UtilBundle\Logic\Attributes as BaseAttributes;
use LogicException;

/**
 * Class AbstractColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\Column
 */
abstract class AbstractColumn extends AbstractDecorator {
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
     * @var string
     */
    private $sort = DataProviderInterface::SORT;

    /**
     * @var bool
     */
    private $isSortable = false;

    /**
     * @var bool
     */
    private $isVisible = true;

    /**
     * @var bool
     */
    private $translate = false;

    /**
     * @var string
     */
    private $translationDomain = 'messages';

    /**
     * @var array
     */
    private $translationParams = [];

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
     * @throws ColumnException
     */
    public function __construct($name, array $options = []) {
        $this->name = $name;

        if (!isset($options['label'])) {
            $options['label'] = $name;
        }
        if (!isset($options['propertyPath'])) {
            $options['propertyPath'] = $name;
        }
        if (!isset($options['attributes'])) {
            $options['attributes'] = [];
        }
        if (!isset($options['sort'])) {
            $options['sort'] = $name;
        }

        foreach ($options as $key => $value) {
            $setMethod = 'set'.ucfirst($key);
            $addMethod = 'add'.ucfirst($key);

            if (method_exists($this, $setMethod)) {
                $this->{$setMethod}($value);
            } elseif(method_exists($this, $addMethod)) {
                $this->{$addMethod}($value);
            } else {
                throw new ColumnException("Property: {$key} not found in class: '".get_class($this)."'");
            }
        }
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
    public function isTranslate() {
        return $this->translate;
    }

    /**
     * @param boolean $translate
     * @param string $domain
     * @param array $params
     */
    public function setTranslate($translate, $domain = 'messages', array $params = []) {
        $this->translate = (boolean) $translate;
        $this->setTranslationDomain($domain);
        $this->setTranslationParams($params);
    }

    /**
     * @return string
     */
    public function getTranslationDomain() {
        return $this->translationDomain;
    }

    /**
     * @param string $translationDomain
     */
    public function setTranslationDomain($translationDomain) {
        $this->translationDomain = (string) $translationDomain;
    }

    /**
     * @return array
     */
    public function getTranslationParams() {
        return $this->translationParams;
    }

    /**
     * @param array $translationParams
     */
    public function setTranslationParams(array $translationParams) {
        $this->translationParams = $translationParams;
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
    public function isVisible() {
        return $this->isVisible;
    }

    /**
     * @param bool $visible
     */
    public function setIsVisible($visible = true) {
        $this->isVisible = (boolean) $visible;
    }

    /**
     * @return bool
     */
    public function isSortable() {
        return $this->isSortable;
    }

    /**
     * @param bool $sortable
     * @param null|string $sort
     */
    public function setIsSortable($sortable = false, $sort = null) {
        $this->isSortable = (boolean) $sortable;
        $this->setSort($sort);
    }

    /**
     * @return mixed
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     * @throws LogicException
     */
    public function setAttributes($attributes) {
        if (is_array($attributes)) {
            $this->attributes = new Attributes($attributes);
        } elseif ($attributes instanceof Attributes) {
            $this->attributes = $attributes;
        } elseif ($attributes instanceof BaseAttributes) {
            $this->attributes = new Attributes($attributes->getAttributes());
        } else {
            throw new LogicException('Attributes is not valid. Only array or Attributes instance.');
        }
    }

    /**
     * @param callable $callable
     * @throws ColumnException
     */
    public function addPostAccessValueEvent($callable) {
        if (is_callable($callable)) {
            $this->postAccessValueEvents[] = $callable;
        } else {
            throw new ColumnException("Post access value event is not callable.");
        }
    }

    /**
     * Clear all post access value events.
     */
    public function clearPostAccessValueEvents() {
        $this->postAccessValueEvents = [];
    }

    /**
     * @return array
     */
    public function getPostAccessValueEvents() {
        return $this->postAccessValueEvents;
    }
}