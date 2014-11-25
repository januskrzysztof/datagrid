<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\DataProvider;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Traversable;
use Tutto\Bundle\DataGridBundle\Exceptions\OrderNotValidException;

/**
 * Class DoctrineDataProvider
 * @package Tutto\Bundle\DataGridBundle\DataGrid\DataProvider
 */
class DoctrineDataProvider extends AbstractDataProvider {
    const ROOT = 'root';

    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository) {
        $this->repository = $repository;
        $this->setSort(self::ROOT.'.'.self::SORT);
        $this->initQueryBuilder();
    }

    /**
     * @return QueryBuilder
     */
    public function initQueryBuilder() {
        return $this->queryBuilder = $this->repository
            ->createQueryBuilder(self::ROOT)
            ->addOrderBy($this->getSort(), $this->getOrder());
    }

    /**
     * @param string $order
     */
    public function setOrder($order) {
        parent::setOrder($order);
        $this->initQueryBuilder();
    }

    /**
     * @param string $sort
     */
    public function setSort($sort) {
        if (count(explode('.', $sort)) <= 1) {
            $sort = self::ROOT.'.'.$sort;
        }

        parent::setSort($sort);
        $this->initQueryBuilder();
    }


    /**
     * @return Traversable
     */
    public function getResult() {
        return $this->getPaginator()->getIterator();
    }

    /**
     * @return int
     */
    public function count() {
        return $this->getPaginator()->count();
    }

    /**
     * @param null|mixed $data
     */
    public function setFilterData($data = null) {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (!empty($val)) {
                    if (count(explode('.', $key)) <= 1) {
                        $key = self::ROOT.'.'.$key;
                    }

                    $this->queryBuilder->andWhere("{$key} LIKE '%{$val}%'");
                }
            }
        }
    }

    /**
     * @return Paginator
     */
    public final function getPaginator() {
        if ($this->paginator === null) {
            $offset = ($this->getPage()-1)*$this->getLimit();
            $query = $this->queryBuilder
                    ->setFirstResult($offset)
                    ->setMaxResults($this->getLimit());

            $this->paginator = new Paginator($query);
        }

        return $this->paginator;
    }
}