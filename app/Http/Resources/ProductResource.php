<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $images = [];
        foreach($this->images as $key => $image) {
            $image_url = env('APP_URL').'/'.$image;

            $images[$key] = $image_url;
        }

        if ($this->category && $this->category->image !== null) {
            $category_image = env('APP_URL').'/'.$this->category->image;

            $this->category->image_url = $category_image;
        }

        return [
            'id' => $this->id,
            'ownerable_type' => $this->ownerable_type,
            'ownerable_id' => $this->ownerable_id,
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description ?? '-',
            'delivery_option' => $this->delivery_option ?? '-',
            'starting_price' => $this->starting_price,
            'fixed_price' => $this->fixed_price,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'buyer_premium_percent' => $this->buyer_premium_percent,
            'bid_increment' => $this->bid_increment,
            'staus' => $this->status,
            'listing_id' => $this->listing_id,
            'item_number' => $this->item_number,
            'images' => $images,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s A')
        ];
    }
}
