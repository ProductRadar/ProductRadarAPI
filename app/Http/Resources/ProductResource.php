<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => [
                'id'                => $this->id,
                'name'              => $this->name,
                'description'       => $this->description,
                'image'             => $this->image,
                'price'             => $this->price,
                'rating'            => $this->rating
            ]
        ];
    }
}
