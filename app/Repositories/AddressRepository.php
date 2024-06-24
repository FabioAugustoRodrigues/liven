<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository extends AbstractRepository
{
    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function getAllByUser(int $user_id, array $filterParams = [])
    {
        $query = $this->model->where('user_id', $user_id);

        if (!empty($filterParams['searchParams'])) {
            $query = $this->setSearchParams($query, $filterParams['searchParams']);
        }

        $perPage = 5;
        $page = 1;

        $this->setPaginationParameters($filterParams, $perPage, $page);

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    protected function setSearchParams($query, array $searchParams)
    {
        $searchableFields = ['street_address', 'city', 'state', 'postal_code', 'country'];

        foreach ($searchableFields as $field) {
            if (!empty($searchParams[$field])) {
                $query->where($field, 'LIKE', '%' . $searchParams[$field] . '%');
            }
        }

        return $query;
    }
}
