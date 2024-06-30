<?php

namespace App\domain\user\repository;

use App\domain\user\User;
use App\domain\user\valueObject\codeVerification\CodeVerification;
use App\domain\user\valueObject\email\Email;
use App\domain\user\valueObject\name\Name;
use App\domain\user\valueObject\password\Password;
use App\domain\user\valueObject\uuid\Uuid;
use App\infrastructure\database\Models\User as UserModel;
use DateTime;

class UserEloquentRepository implements UserRepository
{

    public function create(User $user): void
    {
        $this->domainToModel($user,true)->save();
    }

    public function getByID(Uuid $user_id): User
    {
        $userModel = UserModel::find($user_id->getValue());
        if (is_null($userModel)){
            throw new UserNotFoundException();
        }

        return $this->modelToUserDomain($userModel);
    }

    public function getByEmail(Email $email): User
    {
        $userModel = UserModel::where('email', $email->getValue())->first();
        if (is_null($userModel)){
            throw new UserNotFoundException();
        }

        return $this->modelToUserDomain($userModel);
    }

    public function update(User $user): void
    {
        $this->domainToModel($user,false)->save();
    }

    public function existWithEmail(Email $email): bool
    {
        return !is_null(UserModel::where('email', $email->getValue())->value('email'));
    }

    private function modelToUserDomain(UserModel $model):User
    {
        $created_at = new DateTime($model->created_at);
        $email_verified_at = is_null($model->email_verified_at) ? null : new DateTime($model->email_verified_at);

        return new User(
            id: Uuid::create($model->id),
            name: Name::create($model->name),
            email: Email::create($model->email),
            password: Password::create($model->password,$created_at,true),
            email_verified_at: $email_verified_at,
            codeVerification: is_null($model->email_code_verification) ? null :CodeVerification::create($model->email_code_verification),
            created_at: $created_at
        );
    }

    private function domainToModel(User $user, bool $isNewModel):UserModel{
        if ($isNewModel){
            $userModel = new UserModel();
            $userModel->id = $user->getId()->getValue();
        }else{
            $userModel = UserModel::find($user->getId()->getValue());
        }

        $userModel->name = $user->getName()->getValue();
        $userModel->email = $user->getEmail()->getValue();
        $userModel->password = $user->getPassword()->getValue();
        $userModel->email_verified_at = $user->getEmailVerifiedAt();
        $userModel->created_at = $user->getCreatedAt();
        $userModel->email_code_verification = $user->getCodeVerification()?->getValue();
        return $userModel;
    }
}
