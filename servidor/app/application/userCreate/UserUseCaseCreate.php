<?php


namespace App\application\userCreate;

use App\domain\user\events\created\UserCreatedDispatcher;
use App\domain\user\exception\EmailAlreadyCreateException;
use App\domain\user\repository\UserRepository;
use App\domain\user\User;
use App\domain\user\valueObject\codeVerification\CodeVerification;
use App\domain\user\valueObject\email\Email;
use App\domain\user\valueObject\name\Name;
use App\domain\user\valueObject\password\Password;
use App\domain\user\valueObject\uuid\Uuid;
use DateTime;

class UserUseCaseCreate
{
    public function __construct(
        private UserRepository $repository,
        private UserCreatedDispatcher $eventDispatcher
    ){}

    public function execute(UserUseCaseCreateDtoInput $input): UserUseCaseCreateDtoOutput
    {
        $email = Email::create($input->email);

        if ($this->repository->existWithEmail($email)) {
            throw new EmailAlreadyCreateException();
        }

        $created_at = new DateTime;
        $user = new User(
            id: Uuid::create(''),
            name: Name::create($input->name),
            email: $email,
            password: Password::create($input->password, $created_at, false),
            email_verified_at: null,
            codeVerification: CodeVerification::generate(),
            created_at: $created_at
        );

        $this->repository->create($user);
        $this->eventDispatcher->notify($user);

        return new UserUseCaseCreateDtoOutput(user_id: $user->getId()->getValue());
    }
}
