<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'alt_text' => $this->alt_text,
            'path' => $this->path,
            'type' => $this->type,
            'product_id' => $this->product_id,
        ];
    }
}
