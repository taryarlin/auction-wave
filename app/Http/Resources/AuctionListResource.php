<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionListResource extends JsonResource
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
            'product' => $this->Product,
            'customer' => $this->Customer,
            'amount' => number_format($this->amount, 2),
            'date' => date('Y-m-d', strtotime($this->created_at)),
            'time' => date('H:i:s', strtotime($this->created_at)),
            'created_at' => $this->created_at
        ];
    }
}
