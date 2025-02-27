<?php
namespace Tests\ValueObject;

use App\Attributes\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{

    public function testNameCreation()
    {
        $name = new Name('John Doe');
        $this->assertEquals('John Doe', $name->getValue());
    }

    public function testEmptyName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('');
    }
}