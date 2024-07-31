<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::approved()->latest()->paginate(9);

        return view('frontend.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $auctions = $product->auctions()->latest()->get();

        return view('frontend.detail', compact('product', 'auctions'));
    }
}
