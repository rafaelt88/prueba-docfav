<?php
namespace App\Http\Resources;

use App\Attributes\CreatedAt;
use App\Attributes\Email;
use App\Attributes\Name;
use App\Attributes\UserId;
use App\Core\Base\BaseObject;
use App\Entities\User;

final class UserResponseDTO extends BaseObject
{

    public UserId $id;

    public Name $name;

    public Email $email;

    public CreatedAt $createdAt;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->name = $user->getName();
        $this->email = $user->getEmail();
        $this->createdAt = $user->getCreatedAt();
    }
}