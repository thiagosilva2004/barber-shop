<?php

namespace App\application\userFind;

use App\domain\user\repository\UserRepository;
use App\domain\user\valueObject\uuid\Uuid;

class UserUseCaseFind
{
    public function __construct(
        private UserRepository $repository
    ){}

    public function execute(UserUseCaseFindDtoInput $input):UserUseCaseFindDtoOutput
    {
        $user = $this->repository->getByID(Uuid::create($input->user_id));
        return new UserUseCaseFindDtoOutput(
            email: $user->getEmail()->getValue(),
            name: $user->getName()->getValue()
        );
    }
}
