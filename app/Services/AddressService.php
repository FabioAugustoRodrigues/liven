<?php

namespace App\Services;

use App\Repositories\AddressRepository;

class AddressService
{
    private $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create(array $data)
    {
        return $this->addressRepository->create($data);
    }

    public function getAllByUser(int $user_id)
    {
        return $this->addressRepository->getAllByUser($user_id);
    }
}
