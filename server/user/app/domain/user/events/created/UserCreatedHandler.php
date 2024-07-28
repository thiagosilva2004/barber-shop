<?php

namespace app\domain\user\events\created;

interface UserCreatedHandler
{
    public function execute(UserCreatedEvent $event): void;
}
