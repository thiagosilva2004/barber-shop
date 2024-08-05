<?php

namespace app\infrastructure\email\userConfirmationCode;

interface EmailUserConfirmationCode
{
    public function send(string $name, string $email, string $code):void;
}
