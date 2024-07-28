<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = Category::query()
            ->with('products', 'products.auctions')
            ->has('products')
            ->paginate(3);

        $popular_products = Product::query()
            ->withCount('auctions')
            ->orderBy('auctions_count', 'desc')
            ->paginate(5);

        return view('frontend.index', compact('categories', 'popular_products'));
    }
}
