<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;

class RegisterRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:32',
            ],
            'last_name' => [
                'required',
                'string',
                'max:32',
            ],
            'email' => [
                'required',
                'email',
                'unique:users',
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
            ]
        ];
    }
}
