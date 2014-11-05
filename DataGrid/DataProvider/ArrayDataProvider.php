<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * Class ArrayDataProvider
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
class ArrayDataProvider extends CollectionDataProvider {
    /**
     * @param PropertyAccessorInterface $propertyAccessor
     * @param array $data
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor, array $data) {
        parent::__construct($propertyAccessor, new ArrayCollection($data));
    }
}