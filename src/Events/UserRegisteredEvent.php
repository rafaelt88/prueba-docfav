<?php
namespace App\Events;

use App\Entities\User;

class UserRegisteredEvent
{

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}