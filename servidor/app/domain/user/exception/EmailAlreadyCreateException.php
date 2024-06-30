<?php


namespace App\domain\user\exception;

use App\presentation\exception\ValidationException;

class EmailAlreadyCreateException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('User already created', 'USER_EMAIL_ALREADY_CREATE');
    }
}
