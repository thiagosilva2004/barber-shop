<?php

namespace App\domain\user\valueObject\password;

use DateTime;
use Illuminate\Support\Facades\Hash;

readonly class Password
{
    private function __construct(
        private string $password,
        private DateTime $create_at
    ){}

    public static function create(string $password,DateTime $create_at, bool $isHashed):Password{
        if(!$isHashed && !self::isPasswordValid($password)){
            throw new PasswordInvalidException();
        }

        if (!$isHashed){
            $password = self::generateHash($password, $create_at);
        }

        return new Password($password,$create_at);
    }

    private static function generateHash(string $password, DateTime $create_at):string
    {
        return Hash::make($password . $create_at->format('d/m/y H:i:s'));
    }

    public function compare(string $password):bool
    {
        return Hash::check($password . $this->create_at->format('d/m/y H:i:s'), $this->password);
    }

    private static function isPasswordValid(string $password):bool
    {
        if (strlen($password) < 8 || strlen($password) > 50) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        if (!preg_match('/[\W_]/', $password)) {
            return false;
        }

        return true;
    }

    public function getValue():string
    {
        return $this->password;
    }
}
