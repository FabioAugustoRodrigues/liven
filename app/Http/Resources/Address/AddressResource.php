<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "street_address" => $this->street_address,
            "city" => $this->city,
            "state" => $this->state,
            "postal_code" => $this->postal_code,
            "country" => $this->country,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
