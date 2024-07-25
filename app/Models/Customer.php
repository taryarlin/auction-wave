<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    public function AuctionList()
    {
        return $this->hasMany(AuctionList::class);
    }

    public function getProfileAttribute($value)
    {
        return config('app.url') . '/' . $value;
    }

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
