<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;
use Tutto\Bundle\DataGridBundle\Exceptions\OrderNotValidException;

/**
 * Class AbstractDataProvider
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
abstract class AbstractDataProvider implements DataProviderInterface {
    /**
     * @var int
     */
    private $limit = 30;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var string
     */
    private $sort = 'id';

    /**
     * @var string
     */
    private $order = self::DESC;

    /**
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit($limit) {
        $this->limit = (int) $limit;
    }

    /**
     * @return int
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page) {
        if ($page < 1) {
            $page = 1;
        }

        $this->page = (int) $page;
    }

    /**
     * @return string
     */
    public function getSort() {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort($sort) {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * @param string $order
     * @throws OrderNotValidException
     */
    public function setOrder($order) {
        if (!in_array(strtolower($order), [self::ASC, self::DESC])) {
            throw new OrderNotValidException("Order: '{$order}' is not valid order type. Only: 'asc' or 'desc'.");
        }

        $this->order = $order;
    }
}