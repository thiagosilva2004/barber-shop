<?php

namespace App\domain\user\valueObject\name;

use App\presentation\exception\ValidationException;

class NameInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('name is invalid','NAME_INVALID');
    }
}
