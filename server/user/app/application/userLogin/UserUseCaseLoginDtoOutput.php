<?php

namespace app\application\userLogin;

class UserUseCaseLoginDtoOutput
{
    public function __construct(
        public string $token
    )
    {
    }
}
