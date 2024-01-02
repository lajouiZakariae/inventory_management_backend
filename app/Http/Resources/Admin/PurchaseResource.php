<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            /* 'email' => $this->email,
            'status' => $this->status,
            'delivery' => $this->delivery,
            'createdAt' => $this->created_at,
            'orderItemsCount' => $this->whenCounted('order_items'),
            'fullName' => $this->whenHas('full_name'),
            'phoneNumber' => $this->whenHas('phone_number'),
            'city' => $this->whenHas('city'),
            'zipCode' => $this->whenHas('zip_code'),
            'address' => $this->whenHas('address'),
            'orderItems' => $this->whenLoaded('orderItems'),
            'paymentMethod' => $this->whenLoaded('paymentMethod', new PaymentMethodResource($this->paymentMethod)), */
            'purchaseItemsUrl' => route('purchase-items.index', ['purchase' => $this->id])
        ];
    }
}
