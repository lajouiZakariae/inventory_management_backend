<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => ['string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string', 'min:1', 'max:500'],
            'cost' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'stock_quantity' => ['required', 'integer', 'min:0', 'max:4294967295'],
            'published' => ['required', 'boolean'],
            'category_id' => ['required', 'exists:categories,id'],
            'store_id' => ['nullable', 'exists:stores,id']
        ];
    }
}
