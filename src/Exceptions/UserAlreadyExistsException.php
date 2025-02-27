<?php
namespace App\Exceptions;

class UserAlreadyExistsException extends \RuntimeException
{

    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message ?: "User already exists.", $code);
    }
}