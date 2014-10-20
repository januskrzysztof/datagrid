<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

/**
 * Class LabelsHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class LabelsHelper implements HelperInterface {
    /**
     * @var array
     */
    private $labels = [];

    /**
     * @return $this
     */
    public function init() {
        return $this;
    }

    /**
     * @param string $label
     */
    public function addLabel($label) {
        $this->labels[] = $label;
    }

    /**
     * @return array
     */
    public function getLabels() {
        return $this->labels;
    }

    /**
     * @return string
     */
    public function getName() {
        return 'labels';
    }

    /**
     * @return array
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}