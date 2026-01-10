<?php

namespace App\Http\Requests;

use App\Enums\Enums\ProductSortingOptions;
use App\Enums\ProductFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductsQueryRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    protected function prepareForValidation(): void
    {
        if ($this->has('select')) {
            $this->merge([
                'select' => array_filter(
                    array_map(
                        'trim',
                        explode(',', $this->input('select'))
                    )
                ),
            ]);
        }
    }

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
            'select' => ['sometimes', 'array'],
            'select.*' => [
                'required',
                Rule::enum(ProductFields::class),
            ],
            'skip' => [
                'sometimes',
                'integer',
                'min:0',
                'max:1000'
            ],
            'limit' => [
                'sometimes',
                'integer',
                'min:1',
                'max:1000'
            ],
            'sortBy' => [
                'sometimes',
                Rule::enum(ProductSortingOptions::class)
            ],
            'order' => [
                'required_with:sortBy',
                Rule::in(['asc', 'desc'])
            ],
            'search' => [
                'nullable',
                'string',
            ]
        ];
    }
}
