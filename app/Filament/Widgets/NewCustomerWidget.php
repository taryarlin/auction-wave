<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Database\Console\Migrations\StatusCommand;

class NewCustomerWidget extends BaseWidget
{
    protected static ?int $sort=1;
    protected function getStats(): array
    {
        $pending = Product::where('status','pending')->count();
         
        return [
            Stat::make('All Customers', Customer::count())
            ->description('All customers that have joined.')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('primary'),
            Stat::make('All Products', Product::count())
            ->description('Available products')
            ->descriptionIcon('heroicon-m-inbox-stack', IconPosition::Before)
            ->chart([15,20,25,2,5,10,30,35,40])
            ->color('success'),
            Stat::make('Pending Products', $pending)
            ->description('Products that are still pending')
            ->descriptionIcon('heroicon-m-folder-arrow-down', IconPosition::Before)
            ->chart([2,5,10,30,35,40,7, 2, 10, 20,25])
            ->color('warning'),
        ];
    }

}
