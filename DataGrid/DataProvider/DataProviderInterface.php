<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

use Countable;

/**
 * Interface DataProviderInterface
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
interface DataProviderInterface extends Countable {
    const DESC = 'desc';
    const ASC  = 'asc';
    const SORT = 'id';


    /**
     * @return array
     */
    public function getResult();

    /**
     * @param mixed $data
     * @return void
     */
    public function setFilterData($data = null);

    /**
     * @param int $limit
     * @return void
     */
    public function setLimit($limit);

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param int $page
     * @return void
     */
    public function setPage($page);

    /**
     * @return int
     */
    public function getPage();

    /**
     * @param string $sort
     * @return void
     */
    public function setSort($sort);

    /**
     * @param string $order (asc|desc)
     * @return void
     */
    public function setOrder($order);
}