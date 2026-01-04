<?php

namespace App\Http\Requests;

class CartItemDeleteRequest extends BaseApiRequest
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
            'ids'   => ['required', 'array'],
            'ids.*' => ['integer', 'exists:cart_items,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required'     => 'You must provide at least one cart ID.',
            'ids.array'        => 'The IDs must be an array.',
            'ids.*.integer'    => 'Each cart ID must be an integer.',
            'ids.*.exists'     => 'One or more cart IDs do not exist or do not belong to you.',
        ];
    }
}
