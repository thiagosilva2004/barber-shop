<?php

namespace App\application\userLogin;

use App\domain\user\repository\UserRepository;
use App\domain\user\valueObject\email\Email;
use App\infrastructure\token\Token;

class UserUseCaseLogin
{
    public function __construct(
        private UserRepository $repository,
        private Token $token
    ){}

    public function execute(UserUseCaseLoginDtoInput $input): UserUseCaseLoginDtoOutput
    {
        $user = $this->repository->getByEmail(Email::create($input->email));
        $user->login($input->password);

        return new UserUseCaseLoginDtoOutput($this->token->generate('',$user->getId()->getValue()));
    }
}
