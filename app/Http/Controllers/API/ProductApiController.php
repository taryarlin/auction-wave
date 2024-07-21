<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductApiController extends Controller
{
    public function getAllProducts (Request $request) {
        $now = Carbon::now();
        $twoDaysLater = Carbon::now()->addDays(2);
        $perPage = (int) $request->perPage ?? 10;

        $products = Product::with('Category')
            ->where('start_datetime', '<=', $twoDaysLater)->where('end_datetime', '>=', $now)
            ->where('status', 'approved')
            ->when($request->categoryId, function ($query) use ($request) {
                return $query->where('category_id', $request->categoryId);
            })
            ->paginate($perPage);

        $data = ProductResource::collection($products)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);

        return $data;
    }
}
