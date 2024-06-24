<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Traits\Finders\AddressFinder;
use App\Traits\Finders\UserFinder;

class AddressAuthorization
{
    use AddressFinder;
    use UserFinder;

    public function userCanUpdate(int $user_id, int $address_id): bool
    {
        $user = $this->findUserOrFail($user_id);
        $address = $this->findAddressOrFail($address_id);

        if ($user->id !== $address->user_id) {
            throw new DomainException(["Permission denied to update address."], 403);
        }

        return true;
    }

    public function userCanDelete(int $user_id, int $address_id): bool
    {
        $user = $this->findUserOrFail($user_id);
        $address = $this->findAddressOrFail($address_id);

        if ($user->id !== $address->user_id) {
            throw new DomainException(["Permission denied to delete address."], 403);
        }

        return true;
    }
}
