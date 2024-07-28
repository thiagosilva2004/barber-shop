<?php

namespace app\application\userFind;

class UserUseCaseFindDtoInput
{
    public function __construct(
        public string $user_id
    )
    {
    }
}
