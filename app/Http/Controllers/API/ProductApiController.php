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
    public function getAllProducts () {
        $now = Carbon::now();
        $twoDaysLater = Carbon::now()->addDays(2);

        $products = Product::with('Category')->where('start_datetime', '<=', $twoDaysLater)->where('end_datetime', '>=', $now)->where('status', 'approved')->paginate(5);

        $data = ProductResource::collection($products)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);

        return $data;
    }

    public function store (ProductRequest $productRequest) {
        $attributes = $productRequest->validated();

        if($productRequest->hasFile('images')) {
            $images = $productRequest->file('images');

            $image_lists = [];
            foreach($images as $image) {
                $imgName = 'product-images/'.time(). '_' . uniqid() . '.' .$image->getClientOriginalExtension();
                $image->storeAs('public', $imgName,);

                $image_lists[] = $imgName;
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

        // $attributes = $productRequest->validated();

        // if(){
        //     return $attributes->file('images');
        // }



        // return $product;
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

    public function destroy (Product $product) {
        if ( $product->customer_id == auth::user()->id ) {
            $product->delete();
            return successMessage("Product delete successfully");
        } else {
            return failedMessage("You can't delete this product");
        }
    }
}
