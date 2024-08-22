<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    protected $dates = ['date'];

    const STATUS = ['pending', 'approved', 'rejected', 'finished'];
    const PENDING = self::STATUS[0];
    const APPROVED = self::STATUS[1];
    const REJECTED = self::STATUS[2];
    const FINISHED = self::STATUS[3];

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

    public function scopeFinished($query)
    {
        return $query->where('status', self::FINISHED);
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

    public function isExpired()
    {
        return Carbon::now()->lt(Carbon::parse($this->end_datetime));
    }

    public function winner()
    {
        return $this->belongsTo(Customer::class, 'winner_id', 'id');
    }

}
