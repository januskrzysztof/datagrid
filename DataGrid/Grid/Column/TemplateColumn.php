<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Symfony\Component\Templating\EngineInterface;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Event;
use Tutto\Bundle\DataGridBundle\Exceptions\ColumnException;
use Tutto\Bundle\XhtmlBundle\Xhtml\AbstractTag;
use Tutto\Bundle\XhtmlBundle\Xhtml\Text;

/**
 * Class TemplateColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class TemplateColumn extends AbstractColumn {
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var string
     */
    private $template;

    /**
     * @param string $name
     * @param string $template
     * @param EngineInterface $templating
     * @param array $options
     * @throws ColumnException
     */
    public function __construct($name, $template, EngineInterface $templating = null, array $options = []) {
        parent::__construct($name, $options);
        $this->setTemplate($template);
        $this->setTemplating($templating);
    }

    /**
     * @return EngineInterface
     */
    public function getTemplating() {
        return $this->templating;
    }

    /**
     * @param EngineInterface $templating
     */
    public function setTemplating(EngineInterface $templating) {
        $this->templating = $templating;
    }

    /**
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template) {
        $this->template = $template;
    }

    /**
     * @param Event $event
     * @return AbstractTag
     */
    public function decorate(Event $event) {
        return new Text($this->getTemplating()->render($this->getTemplate(), ['event' => $event]));
    }
}