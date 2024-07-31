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

    const STATUS = ['pending', 'approved', 'rejected'];
    const PENDING = self::STATUS[0];
    const APPROVED = self::STATUS[1];
    const REJECTED = self::STATUS[2];

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
        return $this->belongsToMany(Customer::class, 'customer_product')->withPivot(['amount', 'created_at']);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::APPROVED);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', self::REJECTED);
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
        $last_auction = $this->auctions()->orderBy('pivot_created_at', 'desc')->first();

        return $last_auction->pivot->amount ?? $this->starting_price;
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
