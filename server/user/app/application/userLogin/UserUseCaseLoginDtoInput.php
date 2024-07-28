<?php

namespace app\application\userLogin;

class UserUseCaseLoginDtoInput
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
