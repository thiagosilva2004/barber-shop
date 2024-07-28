<?php

namespace app\domain\user\events\created;

use app\domain\user\User;

interface UserCreatedDispatcher
{
    public function register(string $eventName, UserCreatedHandler $handler): void;

    public function notify(User $user): void;
}
