<?php

namespace App\domain\user\events\created;

class UserCreatedDispatcherFactory
{

    public static function make():UserCreatedDispatcher
    {
        $userCreatedDispatcher = new UserCreatedDispatcherImple();
        return $userCreatedDispatcher;
    }
}
