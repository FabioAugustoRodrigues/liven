<?php

namespace App\Services;

use App\Exceptions\DomainException;
use App\Repositories\UserRepository;
use App\Traits\Validations\CpfValidator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use CpfValidator;

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        $existingUserByEmail = $this->userRepository->getByEmail($data['email']);
        if ($existingUserByEmail) {
            throw new DomainException(['E-mail is already in use'], 409);
        }

        if (!empty($data['cpf'])) {
            $existingUserByCpf = $this->userRepository->getByCpf($data['cpf']);
            if ($existingUserByCpf) {
                throw new DomainException(['CPF is already in use'], 409);
            }

            if (!$this->cpfIsValid($data['cpf'])) {
                throw new DomainException(['CPF is invalid'], 422);
            }
        }

        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        return $user;
    }
}
