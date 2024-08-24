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

        $last_auction_amount = !is_null($last_auction) ? $last_auction->pivot->amount : 0;

        // if( $last_auction_amount >= $request->amount) {
        //     return back()->with('error', 'Your bid price must higher than final bid price.');
        // }

        if ($request->amount <= $last_auction_amount) {
            return back()->with('error', 'Your bid price must be higher than the current bid.');
        }

        // if($product->bid_increment && ($last_auction_amount + $product->bid_increment) >= $request->amount) {
        //     return back()->with('error', 'Your bid price must higher than final bid price.');
        // }

        if ($request->amount != ($last_auction_amount + $product->bid_increment)) {
            return back()->with('error', 'Your bid price must exactly match the next bid increment.');
        }

        // $this->customer()->auctions()->attach($request->product_id, [
        //     'amount' => $request->amount,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $this->customer()->auctions()->attach($request->product_id, [
            'amount' => $request->amount,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your bid price have been placed successfully.');
    }
}
