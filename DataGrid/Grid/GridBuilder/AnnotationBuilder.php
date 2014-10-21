<?php

namespace Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\Column\AbstractColumn;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation;
use Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder\Annotation\Column\Column as ColumnAnnotation;
use ReflectionClass;
use ReflectionObject;

/**
 * Class AnnotationBuilder
 * @package Tutto\Bundle\DataGridBundle\DataGrid\Grid\GridBuilder
 */
class AnnotationBuilder extends AbstractGridBuilder {
    /**
     * @param Reader $reader
     * @param mixed $class
     * @param array $attributes
     */
    public function __construct(Reader $reader, $class, $attributes = []) {
        parent::__construct($attributes);

        if (class_exists($class)) {
            $this->loadAnnotation($reader, new ReflectionClass($class));

            $reflect = new ReflectionClass($class);
            foreach ($reflect->getProperties() as $property) {
//                /** @var Annotation\Column $columnAnnot */
//                $columnAnnot = $reader->getPropertyAnnotation($property, Annotation\Column\Column::class);
//                if ($columnAnnot !== null) {
//                    if ($columnAnnot->getName() === null) {
//                        $columnAnnot->setName($property->getName());
//                    }
//
//                    $columnClass = $columnAnnot->getAliasName();
//                    $column = new $columnClass($columnAnnot->getName());
//
//                    var_dump($columnAnnot->getAttributes());
//
//                    $this->addColumn($column);
//                }
            }


        } else {
            throw new \LogicException("Class: '{$class}' not exists.");
        }
    }

    /**
     * @param Reader $reader
     * @param ReflectionClass $reflection
     */
    public function loadAnnotation(Reader $reader, ReflectionClass $reflection) {
        foreach ($reflection->getProperties() as $property) {
            /** @var ColumnAnnotation $annotation */
            $annotation = $reader->getPropertyAnnotation($property, ColumnAnnotation::class);

            if ($annotation !== null) {
                if ($annotation->getName() === null) {
                    $annotation->setName($property->getName());
                }

                $class   = $annotation->getAliasName();
                $options = $this->loadColumnOptions($annotation);

                /** @var AbstractColumn $column */
                $column = new $class($annotation->getName(), $options);

                $this->addColumn($column);
            }
        }
    }

    /**
     * @param ColumnAnnotation $column
     * @return array
     */
    protected function loadColumnOptions(ColumnAnnotation $column) {
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