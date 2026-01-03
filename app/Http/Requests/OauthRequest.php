<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OauthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'success' => false,
            'global' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function rules(): array
    {
        return [
            'provider' => [
                'required',
                'string',
            ],
            'token' => [
                'required',
                'string'
            ]
        ];
    }
}
