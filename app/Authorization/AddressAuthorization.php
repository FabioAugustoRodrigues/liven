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
        return $this->checkUserPermission($user_id, $address_id, 'Permission denied to update address.');
    }

    public function userCanGet(int $user_id, int $address_id): bool
    {
        return $this->checkUserPermission($user_id, $address_id, 'Permission denied to get address.');
    }

    public function userCanDelete(int $user_id, int $address_id): bool
    {
        return $this->checkUserPermission($user_id, $address_id, 'Permission denied to delete address.');
    }

    private function checkUserPermission(int $user_id, int $address_id, string $errorMessage): bool
    {
        $user = $this->findUserOrFail($user_id);
        $address = $this->findAddressOrFail($address_id);

        if ($user->id !== $address->user_id) {
            throw new DomainException([$errorMessage], 403);
        }

        return true;
    }
}
