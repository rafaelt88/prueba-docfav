<?php
namespace App\Events;

class UserRegisteredEventHandler
{

    public function __invoke(UserRegisteredEvent $event): void
    {
        // Simular que se envia el correo o hace algo.
        // echo "Send email to: " . $event->user->getEmail()->__toString();
    }
}