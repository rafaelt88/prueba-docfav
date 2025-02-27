<?php
namespace App\Core\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\MappedSuperclass
 */
abstract class ObjectValue
{

    abstract public function getValue();

    public function __toString(): string
    {
        return $this->getValue();
    }
}