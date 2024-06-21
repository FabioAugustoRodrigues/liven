<?php

namespace App\Traits\Finders;

use App\Exceptions\DomainException;
use App\Models\Address;

trait AddressFinder
{
    public function findAddressOrFail(int $id): Address
    {
        $address = Address::find($id);

        if (!$address) {
            throw new DomainException(['Address not found.'], 404);
        }

        return $address;
    }
}
