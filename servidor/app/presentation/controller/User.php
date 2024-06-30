<?php

namespace App\presentation\controller;

use App\application\userCreate\UserUseCaseCreate;
use App\application\userCreate\UserUseCaseCreateDtoInput;
use App\application\userFind\UserUseCaseFind;
use App\application\userFind\UserUseCaseFindDtoInput;
use App\application\userLogin\UserUseCaseLogin;
use App\application\userLogin\UserUseCaseLoginDtoInput;
use App\application\userUpdate\UserUseCaseUpdate;
use App\application\userUpdate\UserUseCaseUpdateDtoInput;
use App\application\userVerifyEmail\UserUseCaseVerifyEmail;
use App\application\userVerifyEmail\UserUseCaseVerifyEmailDtoInput;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class User
{
    public function __construct(
        private UserUseCaseCreate $useCaseCreate,
        private UserUseCaseVerifyEmail $userUseCaseVerifyEmail,
        private UserUseCaseUpdate $userUseCaseUpdate,
        private UserUseCaseFind $userUseCaseFind,
        private UserUseCaseLogin $userUseCaseLogin
    ){}

    public function create(Request $request):JsonResponse
    {
        $input = new UserUseCaseCreateDtoInput(
            email: $request->string('email')->value(),
            name: $request->string('name')->value(),
            password: $request->string('password')->value()
        );
        $output = $this->useCaseCreate->execute($input);
        return response()->json(['user_id' => $output->user_id]);
    }

    public function verifyEmail(Request $request): void
    {
        $input = new UserUseCaseVerifyEmailDtoInput(
            user_id: $request->string('user_id')->value(),
            code:  $request->string('code')->value()
        );
        $this->userUseCaseVerifyEmail->execute($input);
    }

    public function update(Request $request):void
    {
        $input = new UserUseCaseUpdateDtoInput
        (
            user_id: $request->string('user_id')->value(),
            name: $request->string('name')->value()
        );
        $this->userUseCaseUpdate->execute($input);
    }

    public function find(string $user_id):JsonResponse
    {
        $output = $this->userUseCaseFind->execute(new UserUseCaseFindDtoInput($user_id));
        return response()->json(['email' => $output->email, 'name' => $output->name]);
    }

    public function login(Request $request):JsonResponse
    {
        $input = new UserUseCaseLoginDtoInput(
            email: $request->string('email')->value(),
            password: $request->string('password')->value()
        );
        $output = $this->userUseCaseLogin->execute($input);
        return response()->json(['token' => $output->token]);
    }
}
