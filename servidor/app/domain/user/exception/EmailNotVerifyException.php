<?php

namespace App\domain\user\exception;

use App\presentation\exception\ValidationException;

class EmailNotVerifyException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email not verify','EMAIL_NOT_VERIFY');
    }
}
