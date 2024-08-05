<?php

namespace app\providers;

use app\domain\user\events\created\UserCreatedDispatcher;
use app\domain\user\events\created\UserCreatedDispatcherFactory;
use app\domain\user\repository\UserEloquentRepository;
use app\domain\user\repository\UserRepository;
use app\infrastructure\email\userConfirmationCode\EmailUserConfirmationCode;
use app\infrastructure\email\userConfirmationCode\EmailUserConfirmationCodeWithMessageBroker;
use app\infrastructure\email\userWelcome\EmailUserWelcome;
use app\infrastructure\email\userWelcome\EmailUserWelcomeWithMessageBroker;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
        $this->app->bind(UserCreatedDispatcher::class, function () {
            return UserCreatedDispatcherFactory::make();
        });
        $this->app->bind(
            EmailUserWelcome::class,
            EmailUserWelcomeWithMessageBroker::class);
        $this->app->bind(
            EmailUserConfirmationCode::class,
            EmailUserConfirmationCodeWithMessageBroker::class
        );
    }


    public function boot(): void
    {

    }
}
