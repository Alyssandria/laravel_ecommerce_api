<?php

namespace App\Http\Requests;


class AddressUpdateRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $address = $this->route('address');
        return $this->user()->can('update', $address);
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
                'sometimes',
                'string',
                'max:255'
            ],
            'province' => [
                'sometimes',
                'string',
                'max:255'
            ],
            'city' => [
                'sometimes',
                'string',
                'max:255'
            ],
            'street' => [
                'sometimes',
                'string',
                'max:255'
            ],
            'label' => [
                'sometimes',
                'unique:addresses',
                'string',
                'max:255'
            ],
            'email' => [
                'sometimes',
                'email',
            ],
            'phone' => [
                'sometimes',
                'regex:/^09[0-9]{9}$/'
            ],
        ];
    }
}
