<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Base;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\BaseBuilder;

/**
 * Interface AppendSettingsInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\BaseGridBuilder
 */
interface AppendSettingsInterface {
    /**
     * @param BaseBuilder $builder
     */
    public function appendSettings(BaseBuilder $builder);
}