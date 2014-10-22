<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Doctrine\Common\Annotations\Reader;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation\Column\Column as ColumnAnnotation;
use ReflectionClass;
use ReflectionObject;
use Tutto\Bundle\UtilBundle\Exceptions\ClassNotFoundException;

/**
 * Class AnnotationBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
class AnnotationBuilder extends AbstractGridBuilder {
    /**
     * @var Reader
     */
    private $reader;

    /**
     * @param Reader $reader
     * @param array $attributes
     */
    public function __construct(Reader $reader, $attributes = []) {
        parent::__construct($attributes);
        $this->reader = $reader;
    }

    /**
     * @param mixed $class
     * @return $this
     * @throws ClassNotFoundException
     */
    public function load($class) {
        if (class_exists($class)) {
            $reflection = is_object($class) ? new ReflectionObject($class) : new ReflectionClass($class);
            $columns    = $this->loadColumns($this->reader, $reflection);

            foreach ($columns as $column) {
                $this->addColumn($column);
            }

            return $this;
        } else {
            throw new ClassNotFoundException(get_class($class));
        }
    }

    /**
     * @param Reader $reader
     * @param ReflectionClass $reflection
     * @return array
     */
    public static function loadColumns(Reader $reader, ReflectionClass $reflection) {
        $columns = [];
        foreach ($reflection->getProperties() as $property) {
            /** @var ColumnAnnotation $annotation */
            $annotation = $reader->getPropertyAnnotation($property, ColumnAnnotation::class);

            if ($annotation !== null) {
                if ($annotation->getName() === null) {
                    $annotation->setName($property->getName());
                }

                $class   = $annotation->getAliasName();
                $options = self::loadColumnOptions($annotation);

                /** @var AbstractColumn $column */
                $column = new $class($annotation->getName(), $options);

                $columns[] = $column;
            }
        }

        return $columns;
    }

    /**
     * @param ColumnAnnotation $column
     * @return array
     */
    protected static function loadColumnOptions(ColumnAnnotation $column) {
        $options    = [];
        $reflection = new ReflectionObject($column);
        foreach ($reflection->getProperties() as $property) {
            $getter = 'get'.ucfirst($property->getName());
            $ask    = ucfirst($property->getName());

            if (method_exists($column, $getter)) {
                $method = $reflection->getMethod($getter);
            } elseif (method_exists($column, $ask)) {
                $method = $reflection->getMethod($ask);
            } else {
                $method = null;
            }

            if ($method !== null && $method->isPublic()) {
                $options[$property->getName()] = $method->invoke($column);
            }
        }

        return $options;
    }
}