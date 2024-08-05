<?php

namespace app\infrastructure\email\userConfirmationCode;

use app\domain\user\events\created\UserCreatedEvent;
use app\domain\user\events\created\UserCreatedHandler;
use app\infrastructure\messageBroker\MessageBroker;
use Illuminate\Support\Facades\App;

class EmailUserConfirmationCodeUserCreatedHandler implements UserCreatedHandler
{

    public function execute(UserCreatedEvent $event): void
    {
        $emailConfirmationCode = App::make(EmailUserConfirmationCodeWithMessageBroker::class);
        $emailConfirmationCode->send($event->name, $event->email, $event->emailCodeVerification);
    }
}
