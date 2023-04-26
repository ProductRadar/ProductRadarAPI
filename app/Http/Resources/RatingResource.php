<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'rating' => [
                'rating'               => $this->rating,
                'user_id'              => $this->user_id,
                'product_id'           => $this->product_id
            ]
        ];
    }
}
