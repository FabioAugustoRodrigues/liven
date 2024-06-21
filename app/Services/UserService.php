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
        $data = $this->validateUserAttributes($data);

        return $this->userRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->userRepository->getById($id);

        $data = $this->validateUserAttributes($data, $user);

        return $this->userRepository->update($id, $data);
    }

    private function validateUserAttributes(array $data, $existingUser = null)
    {
        if (!empty($data['email'])) {
            $existingUserByEmail = $this->userRepository->getByEmail($data['email']);
            if ($existingUserByEmail && (!$existingUser || $existingUser->email !== $data['email'])) {
                throw new DomainException(['E-mail is already in use'], 409);
            }
        }

        if (!empty($data['cpf'])) {
            $existingUserByCpf = $this->userRepository->getByCpf($data['cpf']);
            if ($existingUserByCpf && (!$existingUser || $existingUser->cpf !== $data['cpf'])) {
                throw new DomainException(['CPF is already in use'], 409);
            }

            if (!$this->cpfIsValid($data['cpf'])) {
                throw new DomainException(['CPF is invalid'], 422);
            }
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
