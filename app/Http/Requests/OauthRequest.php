<?php

namespace App\Http\Requests;

class OauthRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
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
