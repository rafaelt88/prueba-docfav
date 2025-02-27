<?php
namespace Tests\ValueObject;

use App\Attributes\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{

    public function testEmailCreation()
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->getValue());
    }

    public function testInvalidEmail()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('invalid-email');
    }
}