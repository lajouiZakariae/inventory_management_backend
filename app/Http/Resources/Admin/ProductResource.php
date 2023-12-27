<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cost' => $this->cost,
            'price' => $this->price,
            'stockQuantity' => $this->stock_quantity,
            'published' => $this->published,
            'categoryId' => $this->category_id,
            'storeId' => $this->store_id,
            'url' => route('products.show', ['product' => $this->id]),
        ];
    }
}
