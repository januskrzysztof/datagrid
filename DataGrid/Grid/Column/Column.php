<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\ValueDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\ColumnException;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;

/**
 * Class Column
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Decorator\Column
 */
class Column extends AbstractColumn {
    /**
     * @var ValueDecorator
     */
    private $decorator;

    /**
     * @param string $name
     * @param array $options
     * @throws ColumnException
     */
    public function __construct($name, array $options = []) {
        parent::__construct($name, $options);
        $this->decorator = new ValueDecorator();
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return $this->decorator->decorate($event);
    }
}