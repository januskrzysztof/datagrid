<?php

namespace Tutto\Bundle\DataGridBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route as BaseRoute;
use BadMethodCallException;
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
        $path = rtrim($this->getPath(), '/').'/{page}/{limit}/{sort}/{order}';
        $requirements = array_merge(
            [
                'page'  => '\d+',
                'limit' => '\d+',
                'order' => '('.DataProviderInterface::DESC.'|'.DataProviderInterface::ASC.')'
            ],
            $this->getRequirements()
        );

        $defaults = array_merge(
            [
                'page'  => 1,
                'limit' => 30,
                'sort'  => DataProviderInterface::SORT,
                'order' => DataProviderInterface::DESC
            ],
            $this->getDefaults()
        );

        $this->setPath($path);
        $this->setRequirements($requirements);
        $this->setDefaults($defaults);
    }
}