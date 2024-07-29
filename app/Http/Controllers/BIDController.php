<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BIDController extends Controller
{
    public function makeBid(Request $request)
    {
        if(!auth()->guard('customer')->check()) {
            return back()->with('error', 'Please sign in to make a bid');
        }

        $product = Product::find($request->product_id);

        $last_auction = $product->auctions()->orderBy('pivot_created_at', 'desc')->first();

        if($last_auction->pivot->amount >= $request->amount) {
            return back()->with('error', 'Your bid must be higher than the previous bid amount');
        }

        if($product->bid_increment && ($last_auction->pivot->amount + $product->bid_increment) >= $request->amount) {
            return back()->with('error', 'Your bid must be higher than the last bid amount plus the bid increment');
        }

        $this->customer()->auctions()->attach($request->product_id, [
            'amount' => $request->amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your BID is successfully placed');
    }
}
