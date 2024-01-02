<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'supplierId' => ['required', 'exists:suppliers,id'],
            'paid' => ['required', 'boolean'],
            'deliveryDate' => ['required', 'date'],
            'paymentMethodId' => ['required', 'exists:payment_methods,id'],
            'storeId' => ['required', 'exists:stores,id'],
        ];
    }
}
