<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column;

use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\AbstractDecorator;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\Decorator\ValueDecorator;

/**
 * Class CustomColumn
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column
 */
class CustomColumn extends AbstractColumn {
    /**
     * @var AbstractDecorator
     */
    private $decorator;

    private $useValueDecorator = true;

    /**
     * @param AbstractDecorator $decorator
     * @param string $name
     * @param array $options
     */
    public function __construct(AbstractDecorator $decorator, $name, array $options = []) {
        $this->decorator = $decorator;
        parent::__construct($name, $options);
    }

    /**
     * @return AbstractDecorator
     */
    protected function initDecorator() {
        if ($this->isUseValueDecorator()) {
            $this->decorator->addDecorator(new ValueDecorator(), AbstractDecorator::APPEND);
        }

        return $this->decorator;
    }

    /**
     * @param mixed $decorator
     */
    public function setDecorator(AbstractDecorator $decorator) {
        $this->decorator = $decorator;
    }

    /**
     * @return boolean
     */
    public function isUseValueDecorator() {
        return $this->useValueDecorator;
    }

    /**
     * @param boolean $useValueDecorator
     */
    public function setUseValueDecorator($useValueDecorator) {
        $this->useValueDecorator = $useValueDecorator;
    }
}