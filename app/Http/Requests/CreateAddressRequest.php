<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recipient_name' => [
                'required',
                'string',
                'max:255'
            ],
            'province' => [
                'required',
                'string',
                'max:255'
            ],
            'city' => [
                'required',
                'string',
                'max:255'
            ],
            'street' => [
                'required',
                'string',
                'max:255'
            ],
            'label' => [
                'required',
                'unique:addresses',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'email',
            ],
            'phone' => [
                'required',
                'regex:/^09[0-9]{9}$/'
            ],
        ];
    }
}
