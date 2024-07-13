<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($this->image !== null) {
            $category_image = env('APP_URL').'/'.$this->image;
        }
        $now = Carbon::now();
        $twoDaysLater = Carbon::now()->addDays(2);

        $products = Product::where('category_id', $this->id)
            ->where('start_datetime', '<=', $twoDaysLater)
            ->where('end_datetime', '>=', $now)
            ->where('status', 'approved')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        foreach ($products as $product) {
            $image_urls = [];
            foreach ($product->images as $image) {
                $image_urls[] = env('APP_URL').'/'.$image;
            }
            $product->image_urls = $image_urls;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $category_image ?? null,
            'products' => $products,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
