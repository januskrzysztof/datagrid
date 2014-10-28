<?php

namespace Tutto\Bundle\DataGridBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route as BaseRoute;
use BadMethodCallException;
use Tutto\Bundle\DataGridBundle\DataGrid\DataGridFactory;
use Tutto\Bundle\DataGridBundle\DataGrid\DataProvider\DataProviderInterface;

/**
 * Class Route
 * @package Tutto\Bundle\DataGridBundle\Configuration
 *
 * @Annotation
 */
class Route extends BaseRoute {
    /**
     * Constructor.
     *
     * @param array $data An array of key/value parameters.
     *
     * @throws BadMethodCallException
     */
    public function __construct(array $data) {
        parent::__construct($data);
        $path = rtrim($this->getPath(), '/').'/';
        $path.= implode('/', [
            '{'.DataGridFactory::PAGE_NAME.'}',
            '{'.DataGridFactory::LIMIT_NAME.'}',
            '{'.DataGridFactory::SORT_NAME.'}',
            '{'.DataGridFactory::ORDER_NAME.'}'
        ]);

        $requirements = array_merge(
            [
                DataGridFactory::PAGE_NAME  => '\d+',
                DataGridFactory::LIMIT_NAME => '\d+',
                DataGridFactory::ORDER_NAME => '('.DataProviderInterface::DESC.'|'.DataProviderInterface::ASC.')'
            ],
            $this->getRequirements()
        );

        $defaults = array_merge(
            [
                DataGridFactory::PAGE_NAME  => 1,
                DataGridFactory::LIMIT_NAME => 30,
                DataGridFactory::SORT_NAME  => DataProviderInterface::SORT,
                DataGridFactory::ORDER_NAME => DataProviderInterface::DESC
            ],
            $this->getDefaults()
        );

        $this->setPath($path);
        $this->setRequirements($requirements);
        $this->setDefaults($defaults);
    }
}