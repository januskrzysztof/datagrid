<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\LinkColumn as BaseColumn;

/**
 * Class LinkColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation
 *
 * @Annotation()
 */
class LinkColumn extends Column {
    /**
     * @var string
     */
    private $href;

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
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getAliasName() {
        return BaseColumn::class;
    }
}