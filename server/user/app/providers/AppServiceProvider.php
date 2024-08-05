<?php

namespace app\providers;

use app\infrastructure\messageBroker\MessageBroker;
use app\infrastructure\messageBroker\RabbitMqFactory;
use app\infrastructure\token\Token;
use app\infrastructure\token\TokenJWT;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Token::class, TokenJWT::class);
        $this->app->bind(MessageBroker::class, function () {
           return RabbitMqFactory::create();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
