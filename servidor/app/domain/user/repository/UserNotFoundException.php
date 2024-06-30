<?php

namespace App\domain\user\repository;

use App\presentation\exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('user not found','USER_NOT_FOUND');
    }
}
