<?php

namespace app\domain\user\exception;

use app\presentation\exception\ValidationException;

class EmailNotVerifyException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email not verify', 'EMAIL_NOT_VERIFY');
    }
}
