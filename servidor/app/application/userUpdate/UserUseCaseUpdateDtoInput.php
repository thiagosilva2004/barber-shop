<?php

namespace App\application\userUpdate;

class UserUseCaseUpdateDtoInput
{
    public function __construct(
        public string $user_id,
        public string $name
    ){}
}
