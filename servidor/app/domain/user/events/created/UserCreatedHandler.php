<?php

namespace App\domain\user\events\created;

interface UserCreatedHandler
{
    public function execute(UserCreatedEvent $event):void;
}
