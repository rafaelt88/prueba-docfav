<?php
namespace Tests\ValueObject;

use App\Attributes\Password;
use App\Exceptions\WeakPasswordException;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{

    public function testPasswordCreation()
    {
        $password = new Password('Securepassword123.');
        $this->assertIsString($password->getValue());
    }

    public function testShortPassword()
    {
        $this->expectException(WeakPasswordException::class);
        new Password('short');
    }
}