<?php

namespace app\domain\user\valueObject\uuid;

use app\presentation\exception\ValidationException;

class UuidInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('uuid is invalid', 'UUID_INVALID');
    }
}
