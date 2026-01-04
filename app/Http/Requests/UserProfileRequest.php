<?php

namespace App\Http\Requests;

class UserProfileRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'sometimes',
                'string',
                'max:32'
            ],
            'last_name' => [
                'sometimes',
                'string',
                'max:32'
            ],
        ];
    }

}
