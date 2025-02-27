<?php
namespace App\Exceptions;

class InvalidEmailException extends \InvalidArgumentException
{

    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message ?: "Invalid email address.", $code);
    }
}