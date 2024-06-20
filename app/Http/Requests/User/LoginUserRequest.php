<?php

namespace App\Http\Requests\User;

use App\Exceptions\DomainException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
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