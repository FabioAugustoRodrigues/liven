<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('users', [UserController::class, 'create']);
Route::post('users/login', [UserController::class, 'login']);