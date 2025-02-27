<?php
namespace Tests\ValueObject;

use App\Attributes\Email;
use PHPUnit\Framework\TestCase;
use App\Exceptions\InvalidEmailException;

class EmailTest extends TestCase
{

    public function testEmailCreation()
    {
        $email = new Email('test@example.com');
        $this->assertIsString($email->getValue());
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalid-email');
    }
}