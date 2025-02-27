<?php
namespace App\Core\Base;

use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
abstract class ObjectValue
{

    abstract public function getValue();

    public function __toString(): string
    {
        return $this->getValue();
    }
}