<?php

namespace App\Http\Requests\Address;

use App\Exceptions\DomainException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    public function rules()
    {
        return [
            'street_address' => 'string|max:255',
            'city' => 'string|max:100',
            'state' => 'string|max:100',
            'postal_code' => 'string|max:20',
            'country' => 'string|max:100'
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new DomainException($validator->messages()->all(), 422);
    }
}