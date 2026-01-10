<?php

namespace App\Http\Requests;

use App\Enums\ProductFields;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductGetQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


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
        ];
    }
}
