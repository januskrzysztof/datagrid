<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

/**
 * Class ArrayDataProvider
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
class ArrayDataProvider extends AbstractDataProvider {
    /**
     * @var array
     */
    private $result = [];

    /**
     * @param array $result
     */
    public function __construct(array $result) {
        $this->result = $result;
    }

    /**
     * @return array
     */
    public function getResult() {
        $limit  = $this->getLimit();
        $offset = ($this->getPage()-1)*$limit;
        $result = array_slice($this->result, $offset, $limit);

        uasort($result, function ($a, $b) {
            $sort = $this->getSort();
            if ($this->getOrder() === self::ASC) {
                return strnatcmp($a[$sort], $b[$sort]);
            } else {
                return strnatcmp($b[$sort], $a[$sort]);
            }
        });

        return $result;
    }

    /**
     * @param null $data
     */
    public function setFilterData($data = null) {
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->result);
    }

    public function setOrder($order) {
        if ($order == SORT_ASC) {
            $order = 'asc';
        } elseif ($order == SORT_DESC) {
            $order = 'desc';
        }

        parent::setOrder($order);
    }
}