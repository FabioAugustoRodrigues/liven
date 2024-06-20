<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $existingUser = $this->userRepository->getByEmail($data['email']);
        if ($existingUser) {
            throw new DomainException(['E-mail is already in use'], 409);
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        return $user;
    }
}