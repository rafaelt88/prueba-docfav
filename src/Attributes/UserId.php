<?php
namespace App\Attributes;

use App\Core\Base\ObjectValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class UserId extends ObjectValue
{

    #[Column(type: 'uuid')]
    private string $id;

    public function __construct(?string $uuid = null)
    {
        if (is_null($uuid)) {
            $uuid = uuid_create();
        } elseif (! uuid_is_valid($uuid)) {
            throw new \InvalidArgumentException("Invalid UUID");
        }
        $this->id = $uuid;
    }

    public function getValue(): string
    {
        return $this->id;
    }
}