<?php

namespace app\domain\user\repository;

use app\presentation\exception\NotFoundException;

class UserNotFoundException extends NotFoundException
{
    public function __construct()
    {
        parent::__construct('user not found', 'USER_NOT_FOUND');
    }
}
