<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\ClassGridBuilder\AppendSettingsInterface;

/**
 * Class ClassGridBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
class ClassGridBuilder extends AbstractGridBuilder {
    /**
     * @var AppendSettingsInterface
     */
    private $settingsClass;

    /**
     * @param AppendSettingsInterface $settingsClass
     * @param array $attributes
     */
    public function __construct(AppendSettingsInterface $settingsClass, $attributes = []) {
        parent::__construct($attributes);
        $this->settingsClass = $settingsClass;
    }

    public function build() {
        $this->settingsClass->appendSettings($this);
    }
}