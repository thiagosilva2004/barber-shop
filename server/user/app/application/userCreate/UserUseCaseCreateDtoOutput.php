<?php

namespace app\application\userCreate;

class UserUseCaseCreateDtoOutput
{
    public function __construct(
        public string $user_id,
        public string $name,
        public string $email,

    )
    {
    }
}
