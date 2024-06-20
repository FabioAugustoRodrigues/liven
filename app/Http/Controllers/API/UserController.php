<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\AuthService;
use App\Services\UserService;

class UserController extends BaseController
{
    protected $userService;
    protected $authService;

    public function __construct(
        UserService $userService,
        AuthService $authService
    ) {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function create(CreateUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        return $this->sendResponse(
            [
                "user" => new UserResource($user)
            ],
            "User created successfully!",
            201
        );
    }

    public function login(LoginUserRequest $request)
    {
        return $this->sendResponse(
            $this->authService->login($request->validated()),
            "User logged in successfully!",
            200
        );
    }
}
