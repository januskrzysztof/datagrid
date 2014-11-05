<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class CollectionDataProvider
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
class CollectionDataProvider extends AbstractDataProvider {
    /**
     * @var Collection
     */
    private $collection;

    /**
     * @param Collection $collection
     */
    function __construct(Collection $collection = null) {
        if ($collection === null) {
            $collection = new ArrayCollection();
        }

        $this->setCollection($collection);
    }

    /**
     * @return Collection
     */
    public function getCollection() {
        return $this->collection;
    }

    /**
     * @param Collection $collection
     */
    public function setCollection(Collection $collection) {
        $this->collection = $collection;
    }

    /**
     * @return array
     */
    public function getResult() {
        $limit  = $this->getLimit();
        $offset = ($this->getPage()-1)*$limit;
        $result = $this->collection->slice($offset, $limit);

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
     * @param mixed $data
     * @return void
     */
    public function setFilterData($data = null) {
        
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count() {
        return $this->collection->count();
    }
}