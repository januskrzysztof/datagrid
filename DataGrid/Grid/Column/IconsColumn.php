<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\CallableDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\XhtmlTagDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class IconsColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class IconsColumn extends RouteColumn {
    /**
     * @var IconColumn[]
     */
    private $icons = [];

    /**
     * @param string $name
     * @param array $options
     * @param RouteDefinition $routeDefinition
     */
    public function __construct($name = 'actions', array $options = [], RouteDefinition $routeDefinition = null) {
        if (!isset($options['propertyPath'])) {
            $options['propertyPath'] = 'id';
        }

        parent::__construct($name, $options, $routeDefinition);
    }

    /**
     * @param IconColumn $icon
     */
    public function addIcon(IconColumn $icon) {
        $this->icons[] = $icon;
    }

    /**
     * @return IconColumn[]
     */
    public function getIcons() {
        return $this->icons;
    }

    /**
     * @return CallableDecorator
     */
    protected function initDecorator() {
        $decorator = new XhtmlTagDecorator('div', $this->getAttributes()->all());
        foreach ($this->getIcons() as $icon) {
            if ($icon->getRouteDefinition() === null) {
                $icon->setRouteDefinition($this->getRouteDefinition());
            }

            $decorator->addDecorator($icon->getDecorator(), AbstractDecorator::APPEND);
        }

        return $decorator;
    }
}