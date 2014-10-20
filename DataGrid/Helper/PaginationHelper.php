<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Helper;

use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;

/**
 * Class PaginationHelper
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Helper
 */
class PaginationHelper implements HelperInterface {
    /**
     * @var DataProviderInterface
     */
    private $dataProvider;

    /**
     * @param DataProviderInterface $dataProvider
     */
    public function __construct(DataProviderInterface $dataProvider) {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @return $this
     */
    public function init() {
        return $this;
    }

    /**
     * @return int
     */
    public function count() {
        return $this->dataProvider->count();
    }

    /**
     * @return int
     */
    public function getPage() {
        $page = $this->dataProvider->getPage();
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $this->getPages()) {
            $page = $this->getPages();
        }

        return $page;
    }

    /**
     * @return int
     */
    public function getPages() {
        return (int) ceil($this->count()/$this->getLimit());
    }

    /**
     * @return int
     */
    public function getLimit() {
        return $this->dataProvider->getLimit();
    }

    /**
     * @return int
     */
    public function getPrevious() {
        if ($this->getPage() > 1) {
            return $this->getPage() > $this->getPages() ? $this->getPages() - 1 : $this->getPage() - 1;
        } else {
            return 1;
        }
    }

    /**
     * @return int
     */
    public function getNext() {
        if ($this->getPage() < $this->getPages()) {
            return $this->getPage()+1;
        } else {
            return $this->getPages();
        }
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pagination';
    }

    /**
     * @return array
     */
    public function getCallable() {
        return [$this, 'init'];
    }
}