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
            Stat::make('ဝယ်ယူသူများ', Customer::count())
            ->description('ဝယ်ယူသူများစုစုပေါင်းအရေအတွက်')
            ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('primary'),
            Stat::make('ပစ္စည်းများ', Product::count())
            ->description('ရရှိနိုင်သောပစ္စည်းများအားလုံးစုစုပေါင်းအရေအတွက်')
            ->descriptionIcon('heroicon-m-inbox-stack', IconPosition::Before)
            ->chart([15,20,25,2,5,10,30,35,40])
            ->color('success'),
            Stat::make('ပစ္စည်းများ', $pending)
            ->description('ဆိုင်းငံ့ထားသောပစ္စည်းများအရေအတွက်')
            ->descriptionIcon('heroicon-m-folder-arrow-down', IconPosition::Before)
            ->chart([2,5,10,30,35,40,7, 2, 10, 20,25])
            ->color('warning'),
        ];
    }

}
