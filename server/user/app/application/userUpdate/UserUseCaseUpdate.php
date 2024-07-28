<?php

namespace app\application\userUpdate;

use app\domain\user\repository\UserRepository;
use app\domain\user\valueObject\name\Name;
use app\domain\user\valueObject\uuid\Uuid;

class UserUseCaseUpdate
{
    public function __construct(
        private UserRepository $repository
    )
    {
    }

    public function execute(UserUseCaseUpdateDtoInput $input): UserUseCaseUpdateOutput
    {
        $user = $this->repository->getByID(Uuid::create($input->user_id));
        $user->setName(Name::create($input->name));
        $this->repository->update($user);

        return new UserUseCaseUpdateOutput();
    }
}
