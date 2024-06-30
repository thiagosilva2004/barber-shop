<?php

namespace App\domain\user\valueObject\uuid;

use App\presentation\exception\ValidationException;

class UuidInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('uuid is invalid','UUID_INVALID');
    }
}
