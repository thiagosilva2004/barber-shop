<?php

namespace app\domain\user\events\created;

use app\infrastructure\email\userConfirmationCode\EmailUserConfirmationCodeUserCreatedHandler;
use app\infrastructure\email\userWelcome\EmailUserWelcomeUserCreatedHandler;

class UserCreatedDispatcherFactory
{

    public static function make(): UserCreatedDispatcher
    {
        $userCreatedDispatcher = new UserCreatedDispatcherImple();
        $userCreatedDispatcher->register(
            'SEND_EMAIL_WELCOME',
            new EmailUserWelcomeUserCreatedHandler()
        );
        $userCreatedDispatcher->register(
            'SEND_EMAIL_CONFIRMATION_CODE',
            new EmailUserConfirmationCodeUserCreatedHandler()
        );
        return $userCreatedDispatcher;
    }
}
