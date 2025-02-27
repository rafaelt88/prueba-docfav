<?php
namespace App\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use App\Attributes\Name;
use App\Attributes\UserId;

#[Entity]
class Person
{

    #[Id]
    #[Column(type: 'string')]
    private string $id;

    #[Column(type: 'string')]
    #[Embedded(class: Name::class)]
    private Name $name;

    public function __construct(string $name)
    {
        $this->id = uuid_create();
        $this->name = new Name($name);
    }
    
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}