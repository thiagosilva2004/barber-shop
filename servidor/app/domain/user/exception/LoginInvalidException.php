<?php

namespace App\domain\user\exception;

use App\presentation\exception\ValidationException;

class LoginInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('login is invalid','LOGIN_INVALID');
    }
}
