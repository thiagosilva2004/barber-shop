<?php


namespace App\domain\user\valueObject\email;

readonly class Email
{
    private function __construct(
        private string $value
    )
    {
    }

    public static function create(string $email): Email
    {
        if (!self::isEmailValid($email)) {
            throw new EmailInvalidException();
        }

        return new Email($email);
    }

    private static function isEmailValid(string $email): bool
    {
        return is_string(filter_var($email, FILTER_VALIDATE_EMAIL));
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
