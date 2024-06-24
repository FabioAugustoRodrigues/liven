<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Address\AddressCollection;
use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "cpf" => $this->cpf,
            "email" => $this->email,
            "password" => $this->password,
            "adresses" => new AddressCollection(
                Address::where('user_id', $this->id)->get()
            ),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
