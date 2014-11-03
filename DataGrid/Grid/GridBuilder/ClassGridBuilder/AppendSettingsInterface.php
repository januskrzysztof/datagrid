<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\ClassGridBuilder;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\ClassGridBuilder;

/**
 * Class AppendSettingsInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\ClassGridBuilder
 */
interface AppendSettingsInterface {
    public function appendSettings(ClassGridBuilder $builder);
}