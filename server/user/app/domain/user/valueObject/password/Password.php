<?php

namespace app\domain\user\valueObject\password;

use DateTime;
use Illuminate\Support\Facades\Hash;

readonly class Password
{
    private function __construct(
        private string $password,
        private DateTime $create_at
    )
    {
    }

    public static function create(string $password, DateTime $create_at, bool $isHashed): Password
    {
        if (!$isHashed && !self::isValidPassword($password)) {
            throw new PasswordInvalidException();
        }

        if (!$isHashed) {
            $password = self::generateHash($password, $create_at);
        }

        return new Password($password, $create_at);
    }

    private static function isValidPassword(string $password): bool
    {
        if (!self::validateLength($password)) {
            return false;
        }

        if (!self::validateHasUppercaseLetter($password)) {
            return false;
        }

        if (!self::validateHasLowercaseLetter($password)) {
            return false;
        }

        if (!self::validateHasNumber($password)) {
            return false;
        }

        if (!self::validateHasEspecialLetter($password)) {
            return false;
        }

        return true;
    }

    private static function validateLength(string $password): bool
    {
        return strlen($password) >= 8 && strlen($password) <= 50;
    }

    private static function validateHasUppercaseLetter(string $password): bool
    {
        return preg_match('/[A-Z]/', $password);
    }

    private static function validateHasLowercaseLetter(string $password): bool
    {
        return preg_match('/[a-z]/', $password);
    }

    private static function validateHasNumber(string $password): bool
    {
        return preg_match('/[0-9]/', $password);
    }

    private static function validateHasEspecialLetter(string $password): bool
    {
        return preg_match('/[\W_]/', $password);
    }

    private static function generateHash(string $password, DateTime $create_at): string
    {
        return Hash::make($password . $create_at->format('d/m/y H:i:s'));
    }

    public function getValue(): string
    {
        return $this->password;
    }

    public function compare(string $password): bool
    {
        return Hash::check($password . $this->create_at->format('d/m/y H:i:s'), $this->password);
    }
}
