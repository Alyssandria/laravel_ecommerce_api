<?php

namespace App\Http\Requests;

class CartItemCreateRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => [
                'required',
                'integer'
            ],
            'product_id' => [
                'required',
                'integer'
            ]
        ];
    }
}
