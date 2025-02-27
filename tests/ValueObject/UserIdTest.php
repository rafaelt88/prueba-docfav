<?php
namespace Tests\ValueObject;

use App\Attributes\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{

    public function testUserIdCreation()
    {
        $userId = new UserId('123e4567-e89b-12d3-a456-426614174000');
        $this->assertIsString($userId->getValue());
    }

    public function testInvalidUserId()
    {
        $this->expectException(\InvalidArgumentException::class);
        new UserId('invalid-uuid');
    }
}
