<?php

namespace App\Providers;

use App\infrastructure\token\Token;
use App\infrastructure\token\TokenJWT;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Token::class, TokenJWT::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
