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
        $name = new Name("John Doe");
        $email = new Email("john@example.com");
        $password = new Password("Password123!");

        $user = new User($name, $email, $password);

        $this->assertTrue(uuid_is_valid($user->getId()->getValue()));
        $this->assertEquals($name, $user->getName());
        $this->assertEquals($email, $user->getEmail());
        $this->assertEquals($password, $user->getPassword());
    }
}