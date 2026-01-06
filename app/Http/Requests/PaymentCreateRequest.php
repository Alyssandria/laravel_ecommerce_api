<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PaymentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function after() {
        return [
            function (Validator $validator) {

                $products = $this->input('products', []);
                $total = $this->input('total');

                $calculated = collect($products)->sum(fn ($p) =>
                    $p['price'] * $p['quantity']
                );

                if (round($calculated, 2) !== round($total, 2)) {
                    $validator->errors()->add(
                        'total',
                        'The total does not match the sum of the products.'
                    );
                }
            }
        ];
    }

    public function rules(): array
    {
        return [
            'shipping_id' => [
                'required',
                'integer'
            ],
            'return_url' => [
                'required',
                'url'
            ],
            'cancel_url' => [
                'required',
                'url'
            ],
            'total' => [
                'required',
                'decimal:2',
            ],
            'products' => [
                'required',
                'array'
            ],

            'products.*.price' => [
                'required',
                'decimal:2'
            ],

            'products.*.image' => [
                'required',
                'url',
            ],

            'products.*.quantity' => [
                'required',
                'integer',
            ],

            'products.*.product_name' => [
                'required',
                'string',
            ],

            'products.*.product_link' => [
                'required',
                'url',
            ],
        ];
    }
}
