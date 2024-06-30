<?php

use App\presentation\exception\NotFoundException;
use App\presentation\exception\ValidationException;
use App\presentation\helper\HttpResponseError;
use App\presentation\exception\ForbiddenException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $exception, Request $request) {
            return HttpResponseError::execute(400,$exception->getMessageErrorCode(),$exception->getMessage());
        });

        $exceptions->render(function (NotFoundException $exception, Request $request) {
            return HttpResponseError::execute(404,$exception->getMessageErrorCode(),$exception->getMessage());
        });

        $exceptions->render(function (ForbiddenException $exception, Request $request) {
            return HttpResponseError::execute(403,$exception->getMessageErrorCode(),$exception->getMessage());
        });

        $exceptions->render(function (Throwable $exception, Request $request) {
            return HttpResponseError::execute(500,'SERVER_ERROR','erro insperado no servidor');
        });
    })->create();
