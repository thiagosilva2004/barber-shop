<?php

namespace app\infrastructure\email\userWelcome;

interface EmailUserWelcome
{
    public function send(string $name, string $email):void;
}
