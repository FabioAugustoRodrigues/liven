<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $user = $this->userService->create($request->input());

        return $this->sendResponse(
            [
                "user" => $user
            ],
            "User created successfully!",
            201
        );
    }
}
