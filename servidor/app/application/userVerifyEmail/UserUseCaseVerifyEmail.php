<?php

namespace App\application\userVerifyEmail;

use App\domain\user\repository\UserRepository;
use App\domain\user\valueObject\uuid\Uuid;

class UserUseCaseVerifyEmail
{
    public function __construct(
        private UserRepository $repository
    ){}

    public function execute(UserUseCaseVerifyEmailDtoInput $input):UserUseCaseVerifyEmailDtoOutput
    {
        $user = $this->repository->getByID(Uuid::create($input->user_id));
        $user->verifyEmail($input->code);
        $this->repository->update($user);

        return new UserUseCaseVerifyEmailDtoOutput();
    }
}
