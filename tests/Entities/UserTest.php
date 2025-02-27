<?php
namespace Tests\Unit\Entities;

use App\Entities\User;
use App\Attributes\UserId;
use App\Attributes\Name;
use App\Attributes\Email;
use App\Attributes\Password;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUserCreation()
    {
        $userId = new UserId(uuid_create());
        $name = new Name("John Doe");
        $email = new Email("john@example.com");
        $password = new Password("Password123!");

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
    }
}