<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Base;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\BaseGridBuilder;

/**
 * Interface AppendSettingsInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\BaseGridBuilder
 */
interface AppendSettingsInterface {
    /**
     * @param BaseGridBuilder $builder
     */
    public function appendSettings(BaseGridBuilder $builder);
}