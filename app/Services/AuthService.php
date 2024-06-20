<?php

namespace App\Services;

use App\Exceptions\DomainException;

class AuthService
{

    public function __construct()
    {
    }

    public function login(array $credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            throw new DomainException(['Incorrect login or password.'], 401);
        }

        return $this->getTokenData($token);
    }

    public function getTokenData(string $token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
