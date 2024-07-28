<?php


namespace app\domain\user\exception;

use app\presentation\exception\ValidationException;

class EmailAlreadyCreateException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('User already created', 'USER_EMAIL_ALREADY_CREATE');
    }
}
