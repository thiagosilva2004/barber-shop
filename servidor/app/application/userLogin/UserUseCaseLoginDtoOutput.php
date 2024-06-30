<?php

namespace App\application\userLogin;

class UserUseCaseLoginDtoOutput
{
    public function __construct(
        public string $token
    ){}
}
