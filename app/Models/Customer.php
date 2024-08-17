<?php

namespace App\Models;

use App\Models\Product;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function AuctionList()
    {
        return $this->hasMany(AuctionList::class);
    }

    public function auctions()
    {
        return $this->belongsToMany(Product::class, 'customer_product')->withPivot(['amount', 'created_at']);
    }

    public function getProfileAttribute($value)
    {
        return $value ? Storage::url($value) : 'https://ui-avatars.com/api/?background=random&name=' . $this->name;
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function winning_bids()
    {
        return $this->hasMany(Product::class, 'winner_id', 'id')->finished();
    }

    public function active_bids()
    {
        return $this->auctions();
    }

    public function winners()
    {
        return $this->hasMany(self::class, 'winner_id', 'id');
    }

    public function won_product()
    {
        return $this->hasOne(Product::class, 'winner_id', 'id');
    }

    public function getWinnerNameAttribute()
    {
        return $this->winner_id ? $this->name : '-';
    }
}
