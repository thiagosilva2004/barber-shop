<?php

namespace app\infrastructure\email\userWelcome;

use app\domain\user\events\created\UserCreatedEvent;
use app\domain\user\events\created\UserCreatedHandler;
use app\infrastructure\messageBroker\MessageBroker;
use Illuminate\Support\Facades\App;

class EmailUserWelcomeUserCreatedHandler implements UserCreatedHandler
{
    public function execute(UserCreatedEvent $event): void
    {
        $emailWelcome = App::make(EmailUserWelcomeWithMessageBroker::class);
        $emailWelcome->send($event->name, $event->email);
    }
}
