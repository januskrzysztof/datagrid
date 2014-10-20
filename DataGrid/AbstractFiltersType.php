<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractFiltersType
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
abstract class AbstractFiltersType extends AbstractType {
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'required'        => false
        ]);
    }
}