<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\XhtmlTagDecorator;

/**
 * Class LinkColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class LinkColumn extends AbstractColumn {
    /**
     * @var string
     */
    private $href;

    /**
     * @return ValueDecorator
     */
    protected function initDecorator() {
        $decorator = new ValueDecorator();
        $decorator->addDecorator(new XhtmlTagDecorator('a', ['href' => $this->getHref()]));

        return $decorator;
    }

    /**
     * @return string
     */
    public function getHref() {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref($href) {
        $this->href = (string) $href;
    }
}