<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        dd(request()->user());

        return view('frontend.detail', compact('product'));
    }
}
