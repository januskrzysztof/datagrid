<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;

/**
 * Interface GridBuilderInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
interface GridBuilderInterface extends ContainerAwareInterface{
    public function addColumn(AbstractColumn $column);

    /**
     * @return AbstractColumn
     */
    public function getColumns();
    public function setAttributes($attributes);

    /**
     * @return Attributes
     */
    public function getAttributes();

    /**
     * @return ContainerInterface
     */
    public function getContainer();
}