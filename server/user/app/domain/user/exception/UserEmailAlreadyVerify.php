<?php

namespace app\domain\user\exception;

use app\presentation\exception\ValidationException;

class UserEmailAlreadyVerify extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email already verify', 'USER_EMAIL_ALREADY_VERIFY');
    }
}
