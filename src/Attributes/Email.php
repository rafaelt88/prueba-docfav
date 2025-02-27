<?php
namespace App\Attributes;

use App\Core\Base\ObjectValue;
use App\Exceptions\InvalidEmailException;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class Email extends ObjectValue
{

    #[Column(type: 'string', length: 100)]
    private string $email;

    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->email = $email;
    }

    public function getValue(): string
    {
        return $this->email;
    }
}