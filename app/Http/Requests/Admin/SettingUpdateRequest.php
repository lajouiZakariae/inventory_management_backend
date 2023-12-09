<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'in:theme'],
            'value' => ['required', 'string', 'min:1', 'max:255'],
            'default' => ['required', 'string', 'min:1', 'max:255'],
            'platform' => ['required', 'string', 'in:desktop,web_client,web_admin']
        ];
    }
}
