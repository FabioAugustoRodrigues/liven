<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('users', [UserController::class, 'create']);
Route::post('users/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('users/me', [UserController::class, 'me']);
    Route::put('users/me', [UserController::class, 'update']);
    Route::delete('users/me', [UserController::class, 'delete']);

    Route::post('users/me/adresses', [AddressController::class, 'create']);
    Route::get('users/me/adresses', [AddressController::class, 'getAllByUser']);
    Route::put('users/me/adresses/{id}', [AddressController::class, 'update']);
});
