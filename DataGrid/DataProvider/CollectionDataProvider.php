<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Tutto\Bundle\UtilBundle\Logic\PropertyAccessor;

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
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     * @param Collection $collection
     */
    function __construct(PropertyAccessorInterface $propertyAccessor, Collection $collection = null) {
        $this->propertyAccessor = $propertyAccessor;
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
            $a    = $this->propertyAccessor->getValue($a, $sort);
            $b    = $this->propertyAccessor->getValue($b, $sort);
            if ($this->getOrder() === self::ASC) {
                return strnatcmp($a, $b);
            } else {
                return strnatcmp($b, $a);
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