<?php
namespace App\Attributes;

use App\Core\Base\ObjectValue;
use App\Exceptions\WeakPasswordException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class Password extends ObjectValue
{
    #[Column(type: 'string', length: 60)]
    private string $password;

    public function __construct(string $password)
    {
        if (strlen($password) < 8 || ! preg_match('/[A-Z]/', $password) || ! preg_match('/[0-9]/', $password) || ! preg_match('/[^A-Za-z0-9]/', $password)) {
            throw new WeakPasswordException();
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getValue(): string
    {
        return $this->password;
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}