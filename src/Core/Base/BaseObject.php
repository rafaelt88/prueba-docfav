<?php
namespace App\Core\Base;

abstract class BaseObject
{

    public function toArray(): array
    {
        $attributes = [];

        $properties = (new \ReflectionClass($this))->getProperties();

        array_filter(
            $properties, function (\ReflectionProperty $property) use (&$attributes) {
                $value = $property->getValue($this);

                if ($value instanceof ObjectValue) {
                    $value = $value->__toString();
                }

                $attributes[$property->getName()] = $value;
            }
        );

        return $attributes;
    }
}