<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Base\AppendSettingsInterface;

/**
 * Class BaseBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
class BaseBuilder extends AbstractGridBuilder {
    /**
     * @var AppendSettingsInterface
     */
    private $settings;

    /**
     * @param AppendSettingsInterface $settings
     * @return $this
     */
    public function load(AppendSettingsInterface $settings) {
        $settings->appendSettings($this);
        return $this;
    }

    /**
     * @return AppendSettingsInterface
     */
    public function getSettings() {
        return $this->settings;
    }

    /**
     * @param AppendSettingsInterface $settings
     */
    public function setSettings(AppendSettingsInterface $settings) {
        $this->settings = $settings;
    }
}