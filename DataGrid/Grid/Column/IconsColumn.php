<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\CallableDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class IconsColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class IconsColumn extends AbstractColumn {
    /**
     * @param string $name
     * @param array $options
     */
    public function __construct($name = 'icons', array $options = []) {
        parent::__construct($name, $options);
    }

    /**
     * @return CallableDecorator
     */
    protected function initDecorator() {
        $decorator = new CallableDecorator(function (Event $event) {
            return new Tag('p');
        });

        return $decorator;
    }
}