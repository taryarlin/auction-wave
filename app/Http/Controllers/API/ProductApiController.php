<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
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
            ->when($request->customerId, function ($query) use ($request) {
                return $query->where('customer_id', $request->customerId);
            })
            ->when($request->categoryId, function ($query) use ($request) {
                return $query->where('category_id', $request->categoryId);
            })
            ->paginate($perPage);

        $data = ProductResource::collection($products)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);

        return $data;
    }

    public function productDetail($id) {
        $product = Product::find($id);
        $data = ProductResource::make($product)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);
        return $data;
    }

    public function store (ProductRequest $productRequest) {
        // \Log::info($productRequest->all());

        $attributes = $productRequest->validated();

        if($productRequest->hasFile('images')) {
            $images = $productRequest->file('images');

            $image_lists = [];
            foreach($images as $image) {
                $imgName = 'product-images/'.time(). '_' . uniqid() . '.' .$image->getClientOriginalExtension();
                $image->storeAs('public', $imgName,);

                $image_lists[] = $imgName;
            }
        }

        $attributes['ownerable_type'] = "App\Models\Customer";
        $attributes['ownerable_id'] = Auth::user()->id;
        $attributes['customer_id'] = Auth::user()->id;
        $attributes['listing_id'] = Product::generateUniqueListingId();
        $attributes['item_number'] = Product::generateUniqueItemNumber();
        $attributes['status'] = 'pending';
        $attributes['images'] = $image_lists;

        $product = Product::create($attributes);

        return success($product, "Create product success");
    }

    public function show (Product $product) {
        $images = [];
        foreach($product->images as $key => $image) {
            $image_url = env('APP_URL').'/'.$image;

            $images[$key] = $image_url;
        }

        $product['image_urls'] = $images;

        return success($product);
    }

    public function update (ProductRequest $productRequest, Product $product) {
        if ($product->customer_id === Auth::user()->id) {
            $attributes = $productRequest->validated();

            if($productRequest->hasFile('images')) {
                $images = $productRequest->file('images');

                $image_lists = [];
                foreach($images as $image) {
                    $imgName = 'product-images/'.time(). '_' . uniqid() . '.' .$image->getClientOriginalExtension();
                    $image->storeAs('public', $imgName,);

                    $image_lists[] = $imgName;
                }
            }
            $attributes['images'] = $image_lists;

            $product = $product->update($attributes);

            return success($product, "Update product success");
        } else {
            return failedMessage("You can't edit this product");
        }
    }

    public function destroy (Product $product) {
        if ( $product->customer_id == auth::user()->id ) {
            $product->delete();
            return successMessage("Product delete successfully");
        } else {
            return failedMessage("You can't delete this product");
        }
    }
}
