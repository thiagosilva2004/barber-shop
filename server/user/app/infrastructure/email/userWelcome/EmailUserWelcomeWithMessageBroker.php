<?php

namespace app\infrastructure\email\userWelcome;

use app\infrastructure\messageBroker\MessageBroker;
use app\infrastructure\messageBroker\Queue;
use app\infrastructure\messageBroker\RoutingKey;

class EmailUserWelcomeWithMessageBroker implements EmailUserWelcome
{
    public function __construct(
        private MessageBroker $messageBroker
    )
    {

    }

    public function send(string $name, string $email):void
    {
        $message = [
            "type" => "USER_EMAIL_WELCOME",
            "data" => [
                "name" => $name,
                "email" => $email
            ]
        ];
        $this->messageBroker->publish($message,Queue::EMAIL, RoutingKey::EMAIL);
    }
}
