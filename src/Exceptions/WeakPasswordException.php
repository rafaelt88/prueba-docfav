<?php
namespace App\Exceptions;

class WeakPasswordException extends \InvalidArgumentException
{

    public function __construct(?string $message = null, int $code = 0)
    {
        parent::__construct($message ?: "Password is weak.", $code);
    }
}