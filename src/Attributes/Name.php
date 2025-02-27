<?php
namespace App\Attributes;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;
use App\Core\Base\ObjectValue;

#[Embeddable]
class Name extends ObjectValue
{

    #[Column(type: 'string', length: 100)]
    private string $value;

    public function __construct(string $value)
    {
        if (empty(trim($value))) {
            throw new \InvalidArgumentException();
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}