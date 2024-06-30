<?php


namespace App\domain\user\valueObject\email;

use App\presentation\exception\ValidationException;

class EmailInvalidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('email is invalid', 'EMAIL_INVALID');
    }
}
