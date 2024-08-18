<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Models\Product;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\ProductResource;
use Filament\Infolists\Components\TextEntry;

class ViewProductBidHistory extends Page
{
    public $bid_histories;
    public $bid_histories_total;

    protected static ?string $title = 'လေလံမှတ်တမ်း';

    protected static string $resource = ProductResource::class;

    protected static string $view = 'filament.resources.product-resource.pages.view-product-bid-history';

    public function mount($record)
    {
        $auctions = Product::findOrFail($record)->auctions();
        $this->bid_histories = $auctions->orderBy('amount', 'desc')->orderBy('created_at', 'desc')->limit(20)->get();
        $this->bid_histories_total = $auctions->count();
    }

}
