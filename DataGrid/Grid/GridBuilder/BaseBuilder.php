<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Base\AppendSettingsInterface;
use Tutto\Bundle\XhtmlBundle\Xhtml\Attributes;

/**
 * Class BaseBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
class BaseBuilder extends AbstractGridBuilder {
    /**
     * @param AppendSettingsInterface $settings
     * @param ContainerInterface $container
     */
    public function __construct(AppendSettingsInterface $settings, ContainerInterface $container) {
        parent::__construct(new Attributes());
        $this->setContainer($container);

        $settings->appendSettings($this);
    }

    /**
     * @param $id
     * @return object
     */
    public function get($id) {
        return $this->getContainer()->get($id);
    }
}