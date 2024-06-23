<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Address\CreateAddressRequest;
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
}
