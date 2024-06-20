<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
}
