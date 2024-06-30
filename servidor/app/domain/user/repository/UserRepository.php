<?php


namespace App\domain\user\repository;

use App\domain\user\User;
use App\domain\user\valueObject\email\Email;
use App\domain\user\valueObject\uuid\Uuid;

interface UserRepository
{
    public function create(User $user): void;

    public function getByID(Uuid $user_id): User;
    public function getByEmail(Email $email): User;

    public function update(User $user): void;

    public function existWithEmail(Email $email): bool;
}
