<?php

namespace app\domain\user\valueObject\codeVerification;

use app\presentation\exception\ValidationException;

class CodeVerificationInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('code verification is invalid', 'CODE_VERIFICATION_INVALID');
    }
}
