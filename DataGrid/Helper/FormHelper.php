<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;
use Symfony\Component\Form\FormInterface;

/**
 * Class FormHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class FormHelper implements HelperInterface {
    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @param FormInterface $form
     */
    public function __construct(FormInterface $form) {
        $this->form = $form;
    }

    /**
     * @param null $parent
     * @return \Symfony\Component\Form\FormView
     */
    public function init($parent = null) {
        return $this->form->createView($parent);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'form';
    }

    /**
     * @return string
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}