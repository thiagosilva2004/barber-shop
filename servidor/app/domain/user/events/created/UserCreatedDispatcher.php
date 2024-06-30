<?php

namespace App\domain\user\events\created;

use App\domain\user\User;

interface UserCreatedDispatcher
{
    public function register(string $eventName, UserCreatedHandler $handler):void;
    public function notify(User $user):void;
}
