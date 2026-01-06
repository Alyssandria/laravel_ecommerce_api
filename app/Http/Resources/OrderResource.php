<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_no' => $this->order_no,
            'total' => $this->total,
            'shipping_detals' => new AddressResource($this->whenLoaded('address')),
            'products' => OrderProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
