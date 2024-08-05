<?php

namespace app\domain\user\events\created;

class UserCreatedHandleItem
{
    public function __construct(
        public UserCreatedHandler $handler,
        public string             $eventName
    )
    {
    }
}
