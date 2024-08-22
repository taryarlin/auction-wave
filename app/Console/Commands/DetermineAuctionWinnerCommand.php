<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Console\Command;

class DetermineAuctionWinnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'determine-auction-winner:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To determine who is auction winner';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $productsCount = Product::approved()->where('end_datetime', '<=', $now)->count();
        $this->info("Found {$productsCount} products to process.");

        Product::approved()->where('end_datetime', '<=', $now)->where('status', '!=', Product::FINISHED)->chunk(100, function ($products) use ($now) {
            foreach ($products as $product) {
                $winner = $product->auctions()->orderBy('amount', 'desc')->first();

                if ($winner) {
                    $product->update([
                        'winner_id' => $winner->id,
                        'won_amount' => $winner->pivot->amount,
                        'won_datetime' => $now,
                        'status' => Product::FINISHED,
                    ]);
                    $this->info("Winner found for Product ID {$product->id}: User ID {$winner->id} with bid amount {$winner->pivot->amount}");
                } else {
                    $this->info("No bids found for Product ID {$product->id}.");
                }
            }
        });

        $this->info('Determine auction winners at ' . $now . '.');
        }
}
