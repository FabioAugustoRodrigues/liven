<?php

namespace App\Traits\Finders;

use App\Exceptions\DomainException;
use App\Models\User;

trait UserFinder
{
    public function findUserOrFail(int $id): User
    {
        $user = User::find($id);

        if (!$user) {
            throw new DomainException(['User not found.'], 404);
        }

        return $user;
    }
}
