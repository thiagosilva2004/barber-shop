<?php

namespace app\domain\user\exception;

use app\presentation\exception\ValidationException;

class LoginInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('login is invalid', 'LOGIN_INVALID');
    }
}
