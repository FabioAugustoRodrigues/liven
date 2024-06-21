<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('users', [UserController::class, 'create']);
Route::post('users/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('users/me', [UserController::class, 'me']);
    Route::put('users/me', [UserController::class, 'update']);
    Route::delete('users/me', [UserController::class, 'delete']);
});
