<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AbstractFiltersType
 * @package Tutto\Bundle\DataGridBundle\DataGrid
 */
abstract class AbstractFiltersType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('_submit', 'submit');
        $builder->add('_clear', 'submit');
    }

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