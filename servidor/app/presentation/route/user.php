<?php

use App\presentation\controller\User;
use Illuminate\Support\Facades\Route;

Route::post('user',[User::class, 'create']);
Route::post('user/email_verify',[User::class, 'verifyEmail']);
Route::put('user',[User::class,'update']);
Route::get('user/{user_id}',[User::class, 'find']);
Route::post('login',[User::class, 'login']);
