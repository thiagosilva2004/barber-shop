<?php


namespace App\application\userCreate;

class UserUseCaseCreateDtoInput
{
    public function __construct(
        public string $email,
        public string $name,
        public string $password,
    ){}
}
