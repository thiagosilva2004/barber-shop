<?php

use App\presentation\helper\HttpResponseError;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function (){
    require base_path('app/presentation/route/user.php');
});

Route::fallback(static function (){
    return HttpResponseError::execute(404,'route not found','ROUTE_NOT_FOUND');
});
