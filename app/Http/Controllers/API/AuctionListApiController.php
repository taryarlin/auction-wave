<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuctionListResource;
use App\Models\AuctionList;
use Illuminate\Support\Facades\Auth;

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

        if(isset($latest_auction)) {
            if ($latest_auction->amount !== NULL && $latest_auction->amount <= $auction['amount']) {
                $data = AuctionList::create($auction);

                return success($data, "Listing Success");
            } else {
                return fail("Your amount is lower than latest auction.");
            }
        }
    }
}
