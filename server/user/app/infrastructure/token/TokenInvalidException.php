<?php

namespace app\infrastructure\token;

use app\presentation\exception\ForbiddenException;

class TokenInvalidException extends ForbiddenException
{
    public function __construct()
    {
        parent::__construct('Token is invalid', 'TOKEN_INVALID');
    }
}
