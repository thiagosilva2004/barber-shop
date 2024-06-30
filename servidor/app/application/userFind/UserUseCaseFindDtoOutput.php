<?php

namespace App\application\userFind;

class UserUseCaseFindDtoOutput
{
    public function __construct(
        public string $email,
        public string $name
    ){}
}
