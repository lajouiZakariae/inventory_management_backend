<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MediaPostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'alt_text' => ['required', 'string', 'min:1', 'max:255'],
            'path' => ['required', 'string', 'min:1', 'max:255'],
            'type' => ['required', 'string', 'in:image,video'],
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
