<?php

namespace app\domain\user\valueObject\name;

readonly class Name
{
    private function __construct(
        private string $value
    )
    {
    }

    public static function create(string $name): Name
    {
        if (!self::isNameValid($name)) {
            throw new NameInvalidException();
        }

        return new Name($name);
    }

    private static function isNameValid(string $name): bool
    {
        return mb_strlen($name) >= 3 && mb_strlen($name) <= 200;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
