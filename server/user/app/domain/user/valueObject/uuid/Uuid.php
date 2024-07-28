<?php

namespace app\domain\user\valueObject\uuid;

use Ramsey\Uuid\Uuid as Uuid4;

readonly class Uuid
{
    private function __construct(
        private string $value
    )
    {
    }

    public static function create(string $id): Uuid
    {
        if (empty($id)) {
            $id = (string)Uuid4::uuid4();
        }

        if (!Uuid4::isValid($id)) {
            throw new UuidInvalidException;
        }

        return new Uuid($id);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
