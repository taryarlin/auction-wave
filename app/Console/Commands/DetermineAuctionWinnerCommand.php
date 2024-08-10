<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        // $now = '2024-08-10 00:00:00';

        Product::approved()->where('end_datetime', $now)
            ->whereNull(['winner_id', 'won_amount', 'won_datetime'])
            ->chunk(100, function ($products) use ($now) {
                foreach ($products as $key => $product) {
                    $winner = $product->auctions()->orderBy('amount', 'desc')->first();

                    $product->update([
                        'winner_id' => $winner->id,
                        'won_amount' => $winner->pivot->amount,
                        'won_datetime' => $now,
                        'status' => Product::FINISHED
                    ]);
                }
            });

        Log::info('Determine auction winners at ' . $now . '.');

        $this->info('Determine auction winners at ' . $now . '.');
    }
}
