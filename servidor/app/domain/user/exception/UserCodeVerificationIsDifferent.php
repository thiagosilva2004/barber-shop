<?php

namespace App\domain\user\exception;

use App\presentation\exception\ValidationException;

class UserCodeVerificationIsDifferent extends ValidationException
{
    public function __construct()
    {
        parent::__construct(
            'code verification is different',
            'USER_CODE_VERIFICATION_IS_DIFFERENT'
        );
    }
}
