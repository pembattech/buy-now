<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V1\CartItemResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guestId' => $this->when($this->guest_id !== null, $this->guest_id),
            'userId' => $this->when($this->user_id !== null, $this->user_id),
            'total' => $this->total_price,
            'items' => CartItemResource::collection($this->cartItems),
        ];
    }
}
