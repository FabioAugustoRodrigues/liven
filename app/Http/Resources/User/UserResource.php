<?php

namespace App\Http\Resources\User;

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
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
