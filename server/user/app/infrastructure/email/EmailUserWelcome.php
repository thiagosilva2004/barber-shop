<?php

namespace app\infrastructure\email;

interface EmailUserWelcome
{
    public function send(string $name, string $email);
}
