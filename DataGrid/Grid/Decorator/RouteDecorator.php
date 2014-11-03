<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\DecoratorException;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class RouteDecorator
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator
 */
class RouteDecorator extends AbstractDecorator {
    /**
     * @var RouteDefinition
     */
    private $routeDefinition;

    /**
     * @param RouteDefinition $routeDefinition
     * @param int $placement
     */
    public function __construct(RouteDefinition $routeDefinition = null, $placement = self::APPEND) {
        parent::__construct($placement);
        if ($routeDefinition !== null) {
            $this->routeDefinition = $routeDefinition;
        }
    }

    /**
     * @param Event $event
     * @throws DecoratorException
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        if ($this->routeDefinition === null) {
            throw new DecoratorException("Route definition was not set.");
        }

        $href = $this->routeDefinition->generate($event->getData());

        return new Tag('a', ['href' => $href]);
    }

    /**
     * @return RouteDefinition
     */
    public function getRouteDefinition() {
        return $this->routeDefinition;
    }

    /**
     * @param RouteDefinition $routeDefinition
     */
    public function setRouteDefinition(RouteDefinition $routeDefinition) {
        $this->routeDefinition = $routeDefinition;
    }
}