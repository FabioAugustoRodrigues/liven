<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
}
