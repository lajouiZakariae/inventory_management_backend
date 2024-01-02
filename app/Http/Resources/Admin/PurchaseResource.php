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
            'paid' => $this->paid,
            'deliveryDate' => $this->delivery_date,
            'supplier' => new SupplierResource($this->whenLoaded('supplier', $this->supplier)),
            'paymentMethod' =>  new PaymentMethodResource(
                $this->whenLoaded('paymentMethod', $this->paymentMethod)
            ),
            'store' => new StoreResource(
                $this->whenLoaded('store', $this->store)
            ),
            'purchaseItemsCount' => $this->whenCounted('purchaseItems')
        ];
    }
}
