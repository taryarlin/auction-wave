<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\AuctionList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuctionListResource;

class AuctionListApiController extends Controller
{
    public function getAuctionByProductId(Request $request)
    {
        if(isset($request['product_id'])){
            $auction_lists = AuctionList::where('product_id', $request['product_id'])->get();

            $data = AuctionListResource::collection($auction_lists)->additional(['code' => 200, 'result' => 1, 'message' => 'Success']);

            return $data;
        }

        return failedMessage("Need product id");
    }

    public function store(Request $request)
    {
        $auction = $request->validate([
            'product_id' => ['required'],
            'amount' => ['required']
        ]);

        $auction['customer_id'] = Auth::User()->id;

        $latest_auction = AuctionList::where('product_id', $auction['product_id'])->latest()->first();
        $product = Product::where('id', $auction['product_id'])->first();

        if(isset($latest_auction)) {
            if ($latest_auction->amount !== NULL && $latest_auction->amount < $auction['amount']) {
                if (($auction['amount'] - $latest_auction->amount) >= $product->bid_increment) {
                    $data = AuctionList::create($auction);

                    return success($data, "Listing Success");
                } else {
                    return fail("Your amount is lower than bid increment.");
                }
            } else {
                return fail("Your amount is lower than latest auction.");
            }
        } else {
            $data = AuctionList::create($auction);

            return success($data, "Listing Success");
        }
    }

    public function destroy(AuctionList $auction_list) {
        if ( $auction_list->customer_id == auth::user()->id ) {
            $auction_list->delete();

            return successMessage("Auction delete successfully");
        } else {
            return failedMessage("You can't delete this auction");
        }
    }
}
