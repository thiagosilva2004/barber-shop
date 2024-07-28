<?php


namespace app\domain\user\valueObject\email;

use app\presentation\exception\ValidationException;

class EmailInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email is invalid', 'EMAIL_INVALID');
    }
}
