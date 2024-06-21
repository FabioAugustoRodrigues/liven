<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends AbstractRepository
{
    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function getAllByUser(int $user_id)
    {
        return $this->model->where('user_id', $user_id)->get();
    }
}
