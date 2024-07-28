<?php


namespace app\domain\user\repository;

use app\domain\user\User;
use app\domain\user\valueObject\email\Email;
use app\domain\user\valueObject\uuid\Uuid;

interface UserRepository
{
    public function create(User $user): void;

    public function getByID(Uuid $user_id): User;

    public function getByEmail(Email $email): User;

    public function update(User $user): void;

    public function existWithEmail(Email $email): bool;
}
