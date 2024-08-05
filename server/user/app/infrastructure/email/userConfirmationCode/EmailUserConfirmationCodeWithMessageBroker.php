<?php

namespace app\infrastructure\email\userConfirmationCode;

use app\infrastructure\messageBroker\MessageBroker;
use app\infrastructure\messageBroker\Queue;
use app\infrastructure\messageBroker\RoutingKey;

class EmailUserConfirmationCodeWithMessageBroker implements EmailUserConfirmationCode
{
    public function __construct(
        private MessageBroker $messageBroker
    )
    {

    }

    public function send(string $name, string $email,string $code):void
    {
        $message = [
            "type" => "USER_EMAIL_CONFIRMATION_CODE",
            "name" => $name,
            "email" => $email,
            "code" => $code
        ];
        $this->messageBroker->publish($message,Queue::EMAIL, RoutingKey::EMAIL);
    }
}
