<?php

namespace App\domain\user\exception;

use App\presentation\exception\ValidationException;

class UserEmailAlreadyVerify extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email already verify','USER_EMAIL_ALREADY_VERIFY');
    }
}
