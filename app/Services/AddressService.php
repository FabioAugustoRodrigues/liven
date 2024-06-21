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

}
