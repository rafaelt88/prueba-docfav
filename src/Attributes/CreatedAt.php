<?php
namespace App\Attributes;

use App\Core\Base\ObjectValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class CreatedAt extends ObjectValue
{

    #[Column(type: 'datetime')]
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getValue(): \DateTime
    {
        return $this->createdAt;
    }

    public function __toString(): string
    {
        return $this->getValue()->format('Y-m-d H:i:s');
    }
}