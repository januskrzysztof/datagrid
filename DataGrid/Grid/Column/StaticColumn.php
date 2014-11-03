<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class StaticColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class StaticColumn extends AbstractColumn {
    private $staticValue;

    public function __construct($name, $staticValue, array $options = []) {
        $options['staticValue']  = $staticValue;
        $options['propertyPath'] = false;
        parent::__construct($name, $options);
    }


    /**
     * @return mixed
     */
    public function getStaticValue() {
        return $this->staticValue;
    }

    /**
     * @param mixed $staticValue
     */
    public function setStaticValue($staticValue) {
        $this->staticValue = $staticValue;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return new Text($this->staticValue);
    }
}