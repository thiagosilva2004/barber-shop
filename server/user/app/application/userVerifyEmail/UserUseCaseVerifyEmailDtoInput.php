<?php

namespace app\application\userVerifyEmail;

class UserUseCaseVerifyEmailDtoInput
{
    public function __construct(
        public string $user_id,
        public string $code
    )
    {
    }
}
