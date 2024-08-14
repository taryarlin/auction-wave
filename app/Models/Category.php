<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getAcsrImageAttribute()
    {
        return $this->image ? asset(Storage::url($this->image)) : asset('assets/images/no-product-image.png');
    }
}
