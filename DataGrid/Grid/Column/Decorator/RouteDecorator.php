<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;

/**
 * Class RouteDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator
 */
class RouteDecorator extends XhtmlTagDecorator {
    /**
     * @var RouteDefinition
     */
    private $routeDefinition;

    /**
     * @param RouteDefinition $routeDefinition
     * @param array $attributes
     * @param array $children
     * @param array $decorators
     */
    public function __construct(RouteDefinition $routeDefinition, array $attributes = [], array $children = [], array $decorators = []) {
        parent::__construct('a', $attributes, $children, $decorators);
        $this->routeDefinition = $routeDefinition;
    }

    /**
     * @param Event $event
     * @return XhtmlTagDecorator
     */
    public function decorate(Event $event) {
        $event->addAttribute('href', $this->routeDefinition->generate($event->getData()));

        return parent::decorate($event);
    }

    /**
     * @return null|string
     */
    public function getTarget() {
        if (array_key_exists('target', $this->getAttributes())) {
            return $this->getAttributes()['target'];
        } else {
            return null;
        }
    }

    /**
     * @param string $target
     */
    public function setTarget($target) {
        $this->setAttributes(['target' => $target]);
    }
}