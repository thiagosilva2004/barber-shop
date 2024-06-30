<?php

namespace App\Providers;

use App\domain\user\events\created\UserCreatedDispatcher;
use App\domain\user\events\created\UserCreatedDispatcherFactory;
use App\domain\user\repository\UserEloquentRepository;
use App\domain\user\repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
        $this->app->bind(UserCreatedDispatcher::class, function (){
            return UserCreatedDispatcherFactory::make();
        });
    }


    public function boot(): void
    {

    }
}
