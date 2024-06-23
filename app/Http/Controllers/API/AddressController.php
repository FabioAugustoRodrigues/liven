<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Resources\Address\AddressCollection;
use App\Http\Resources\Address\AddressResource;
use App\Services\AddressService;

class AddressController extends BaseController
{
    protected $addressService;

    public function __construct(
        AddressService $addressService
    ) {
        $this->addressService = $addressService;
    }

    public function create(CreateAddressRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        $data['user_id'] = $user->id;

        return $this->sendResponse(
            new AddressResource($this->addressService->create($data)),
            "Address created successfully!",
            201
        );
    }

    public function getAllByUser()
    {
        $user = auth()->user();

        return $this->sendResponse(
            new AddressCollection($this->addressService->getAllByUser($user->id)),
            "Adresses retrieved successfully!",
            200
        );
    }
}
