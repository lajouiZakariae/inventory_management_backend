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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    protected function prepareForValidation(): void
    {
        $this->replace(['settings_value' => $this->settingsValue]);
    }

    public function rules(): array
    {
        return [
            'settings_value' => [
                'theme' => ['required', 'in:red,green,blue'],
                'font' => ['required', 'in:poppins,consolas'],
                'maintenanceMode' => ['required', 'boolean'],
            ]
        ];
    }
}
