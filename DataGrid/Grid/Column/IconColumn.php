<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\UtilBundle\Logic\RouteDefinition;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class IconColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class IconColumn extends RouteColumn {
    /**
     * @var string
     */
    private $fa;

    /**
     * @param string $name
     * @param RouteDefinition $routeDefinition
     * @param array $options
     */
    public function __construct($name, RouteDefinition $routeDefinition = null, array $options = []) {
        $options['propertyPath'] = false;
        parent::__construct($name, $routeDefinition, $options);

        $this->clearDecorators();
    }

    /**
     * @return mixed
     */
    public function getFa() {
        return $this->fa;
    }

    /**
     * @param mixed $fa
     */
    public function setFa($fa) {
        $this->fa = $fa;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        $xhtml = parent::decorate($event);
        $xhtml->addChild(new Tag('i', ['class' => $this->getFa()]));

        return $xhtml;
    }
}