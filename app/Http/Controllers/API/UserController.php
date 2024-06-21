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

        return $this->sendAuthenticatedUserResponse($user, $request->only(['email', 'password']), "User created successfully!", 201);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->sendResponse(
            $this->authService->login($request->validated()),
            "User logged in successfully!",
            200
        );
    }

    public function me()
    {
        return $this->sendResponse(
            new UserResource(auth()->user()),
            "User data retrieved successfully",
            200
        );
    }

    private function sendAuthenticatedUserResponse($user, $credentials, $message = "", $statusCode = 200)
    {
        $tokenData = $this->authService->login($credentials);

        return $this->sendResponse(
            [
                "user" => new UserResource($user),
                "access_token" => $tokenData['access_token'],
                "token_type" => $tokenData['token_type'],
                "expires_in" => $tokenData['expires_in'],
            ],
            $message,
            $statusCode
        );
    }
}
