<?php

namespace app\domain\user\valueObject\name;

use app\presentation\exception\ValidationException;

class NameInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('name is invalid', 'NAME_INVALID');
    }
}
