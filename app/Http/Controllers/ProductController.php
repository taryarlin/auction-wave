<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('auctions')->approved()->latest()->paginate(9);

        return view('frontend.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $auctions = $product->auctions()->latest()->paginate(20);

        return view('frontend.products.show', compact('product', 'auctions'));
    }
}
