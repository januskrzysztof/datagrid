<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;


use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\ColumnException;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Tag;

/**
 * Class IconsColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class IconsColumn extends AbstractColumn {
    const VISIBILITY_MD = 'visible-md visible-lg hidden-sm hidden-xs';
    const VISIBILITY_XS = 'visible-xs visible-sm hidden-md hidden-lg';

    /**
     * @var IconColumn[]
     */
    private $icons = [];

    /**
     * @var string
     */
    private $visibility = self::VISIBILITY_MD;

    /**
     * @param string $name
     * @param array $options
     * @throws ColumnException
     */
    public function __construct($name = 'actions', $visibility = self::VISIBILITY_MD, array $options = []) {
        $options['propertyPath'] = false;
        $options['visibility'] = $visibility;
        parent::__construct($name, $options);
    }

    /**
     * @return string
     */
    public function getVisibility() {
        return $this->visibility;
    }

    /**
     * @param string $visibility
     */
    public function setVisibility($visibility) {
        $this->visibility = $visibility;
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
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        $xhtml = new Tag('div', ['class' => $this->getVisibility()]);

        foreach ($this->getIcons() as $icon) {
            $xhtml->addChild($icon->decorate($event));
        }

        return $xhtml;
    }
}