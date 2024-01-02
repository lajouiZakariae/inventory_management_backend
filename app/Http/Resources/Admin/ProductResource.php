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
            'title' => $this->whenHas('title'),
            'description' => $this->whenHas('description'),
            'cost' => $this->whenHas('cost'),
            'price' => $this->whenHas('price'),
            'stockQuantity' => $this->whenHas('stock_quantity'),
            'published' => $this->whenHas('published'),
            'categoryId' => $this->whenHas('category_id'),
            'storeId' => $this->whenHas('store_id'),
            'url' => route('products.show', ['product' => $this->id]),
        ];
    }
}
