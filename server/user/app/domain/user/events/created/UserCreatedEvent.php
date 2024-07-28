<?php

namespace app\domain\user\events\created;

use DateTime;

class UserCreatedEvent
{
    public function __construct(
        public DateTime $dateTimeOccurred,
        public string $name,
        public string $email,
        public string $emailCodeVerification
    )
    {
    }
}
