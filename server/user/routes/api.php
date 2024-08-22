<?php

use app\presentation\helper\HttpResponseError;
use app\presentation\middleware\TransactionMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {
    require base_path('app/presentation/route/user.php');
})->middleware([TransactionMiddleware::class]);

Route::fallback(static function () {
    return HttpResponseError::execute(404, 'route not found', 'ROUTE_NOT_FOUND');
});
