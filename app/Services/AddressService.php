<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\Traits\Finders\AddressFinder;

class AddressService
{
    use AddressFinder;

    private $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create(array $data)
    {
        return $this->addressRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $address = $this->findAddressOrFail($id);

        return $this->addressRepository->update($id, $data);
    }

    public function getAllByUser(int $user_id, array $filterParams = [])
    {
        return $this->addressRepository->getAllByUser($user_id, $filterParams);
    }
}
