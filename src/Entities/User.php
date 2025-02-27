<?php
namespace App\Entities;

use App\Attributes\CreatedAt;
use App\Attributes\Email;
use App\Attributes\Name;
use App\Attributes\Password;
use App\Attributes\UserId;
use App\Core\Base\BaseObject;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class User extends BaseObject
{

    #[Id]
    #[Column(type: 'string', length: 36)]
    #[Embedded(class: UserId::class)]
    private string|UserId $id;

    #[Embedded(class: Name::class, columnPrefix: false)]
    private Name $name;

    #[Column(type: 'string', length: 100)]
    #[Embedded(class: Email::class, columnPrefix: false)]
    private string|Email $email;

    #[Embedded(class: Password::class, columnPrefix: false)]
    private Password $password;

    #[Embedded(class: CreatedAt::class, columnPrefix: false)]
    private CreatedAt $createdAt;

    public function __construct(string|Name $name, string|Email $email, string|Password $password)
    {
        $this->id = new UserId();
        $this->name = is_object($name) ? $name : new Name($name);
        $this->email = is_object($email) ? $email : new Email($email);
        $this->password = is_object($password) ? $password : new Password($password);
        $this->createdAt = new CreatedAt();
    }

    public function getId(): UserId
    {
        if (is_string($this->id)) {
            $this->id = new UserId($this->id);
        }
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getCreatedAt(): CreatedAt
    {
        return $this->createdAt;
    }
}