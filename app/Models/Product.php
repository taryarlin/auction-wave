<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->listing_id = self::generateUniqueListingId();
            $product->item_number = self::generateUniqueItemNumber();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function AuctionList()
    {
        return $this->hasMany(AuctionList::class);
    }

    public function auctions()
    {
        return $this->belongsToMany(Customer::class, 'customer_product')->withPivot(['amount']);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function generateUniqueListingId()
    {
        return uniqid();
    }

    public static function generateUniqueItemNumber()
    {
        return Str::uuid();
    }

    public function getCurrentBidAttribute()
    {
        return $this->auctions->first()->pivot->amount ?? $this->starting_price;
    }

    public function getAcsrImagesAttribute()
    {
        $baseUrl = url('/');

        $imageUrls = array_map(function ($image) use ($baseUrl) {
            return $baseUrl . '/storage/' . $image;
        }, $this->images);

        return $imageUrls;
    }
}
