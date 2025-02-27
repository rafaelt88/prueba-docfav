<?php
namespace App\Http\Requests;

use App\Attributes\Name;
use App\Attributes\Email;
use App\Attributes\Password;

final class RegisterUserRequest
{

    public Name $name;

    public Email $email;

    public Password $password;

    public function __construct(Name $name, Email $email, Password $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}