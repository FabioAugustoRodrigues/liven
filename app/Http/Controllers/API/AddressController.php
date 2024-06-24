<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\Address\AddressCollection;
use App\Http\Resources\Address\AddressResource;
use App\Authorization\AddressAuthorization;
use App\Http\Filters\Address\GetAllAdressesFilter;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    protected $addressService;

    protected $addressAuthorization;

    public function __construct(
        AddressService $addressService,

        AddressAuthorization $addressAuthorization
    ) {
        $this->addressService = $addressService;

        $this->addressAuthorization = $addressAuthorization;
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

    public function update(UpdateAddressRequest $updateAddressRequest, $id)
    {
        $user = auth()->user();

        $this->addressAuthorization->userCanUpdate($user->id, $id);

        return $this->sendResponse(
            new AddressResource($this->addressService->update($id, $updateAddressRequest->validated())),
            "Address updated successfully!",
            200
        );
    }

    public function getAllByUser(Request $request)
    {
        $user = auth()->user();

        return $this->sendResponse(
            new AddressCollection($this->addressService->getAllByUser($user->id, GetAllAdressesFilter::getFilter($request))),
            "Adresses retrieved successfully!",
            200
        );
    }

    public function delete($id)
    {
        $user = auth()->user();

        $this->addressAuthorization->userCanDelete($user->id, $id);

        $this->addressService->delete($id);

        return $this->sendResponse(
            "",
            "Address deleted successfully!",
            200
        );
    }
}
