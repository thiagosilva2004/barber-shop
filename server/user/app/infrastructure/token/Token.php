<?php

namespace app\infrastructure\token;

interface Token
{
    public function generate(string $aud, string $user_id): string;

    public function loadFromString(string $token): void;

    public function getUserID(): string;
}
