<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;
use DateTime;

/**
 * Class DateTimeColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class DateTimeColumn extends AbstractColumn {
    private $format = 'Y-m-d H:i:s';

    public function __construct($name, array $options = []) {
        parent::__construct($name, $options);
    }

    /**
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format) {
        $this->format = $format;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        /** @var DateTime $date */
        $date = $event->getValue();

        return new Text($date->format($this->format));
    }
}