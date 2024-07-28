<?php

namespace app\providers;

use app\domain\user\events\created\UserCreatedDispatcher;
use app\domain\user\events\created\UserCreatedDispatcherFactory;
use app\domain\user\repository\UserEloquentRepository;
use app\domain\user\repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
        $this->app->bind(UserCreatedDispatcher::class, function () {
            return UserCreatedDispatcherFactory::make();
        });
    }


    public function boot(): void
    {

    }
}
