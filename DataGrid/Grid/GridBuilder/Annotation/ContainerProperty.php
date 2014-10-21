<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationAnnotation;

/**
 * Class ContainerProperty
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation
 *
 * @Annotation()
 */
class ContainerProperty extends ConfigurationAnnotation {

    public function getAliasName() {
        return 'container_property';
    }

    public function allowArray() {
        return true;
    }
}