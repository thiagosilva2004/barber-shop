<?php

namespace app\infrastructure\email;

interface EmailUserConfirmationCode
{
    public function send(string $code);
}
