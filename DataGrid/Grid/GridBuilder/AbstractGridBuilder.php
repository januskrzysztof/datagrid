<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\UtilBundle\Logic\Attributes as BaseAttributes;

/**
 * Class AbstractBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
abstract class AbstractGridBuilder implements ContainerAwareInterface {
    /**
     * @var AbstractColumn[]
     */
    private $columns = [];

    /**
     * @var Attributes
     */
    private $attributes;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array|Attributes|BaseAttributes $attributes
     */
    public function __construct($attributes = []) {
        $this->setAttributes($attributes);
    }

    /**
     * @return void
     */
    abstract public function build();

    /**
     * @param AbstractColumn $column
     */
    public function addColumn(AbstractColumn $column) {
        $this->columns[] = $column;
    }

    /**
     * @return AbstractColumn[]
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * @param array|Attributes|BaseAttributes $attributes
     */
    public function setAttributes($attributes) {
        if (is_array($attributes)) {
            $attributes = new Attributes($attributes);
        } elseif ($attributes instanceof BaseAttributes) {
            $attributes = new Attributes($attributes->getAttributes());
        } else {
            throw new \LogicException('Attributes is not valid. Only array or Attributes instance.');
        }

        $this->attributes = $attributes;
    }

    /**
     * @return Attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->container;
    }
}