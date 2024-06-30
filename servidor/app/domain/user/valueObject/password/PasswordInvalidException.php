<?php

namespace App\domain\user\valueObject\password;

use App\presentation\exception\ValidationException;

class PasswordInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('password is invalid','PASSWORD_INVALID');
    }
}
