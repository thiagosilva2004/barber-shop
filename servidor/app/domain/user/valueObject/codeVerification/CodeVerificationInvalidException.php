<?php

namespace App\domain\user\valueObject\codeVerification;

use App\presentation\exception\ValidationException;

class CodeVerificationInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('code verification is invalid','CODE_VERIFICATION_INVALID');
    }
}
