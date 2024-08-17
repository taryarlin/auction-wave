<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use App\Filament\Exports\UserExporter;
use Filament\Support\Enums\IconPosition;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CustomerResource;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->color('primary')
                ->outlined()
                ->label("ဝယ်ယူသူအသစ်ထည့်ရန်")
                ->icon('heroicon-m-user-plus', IconPosition::Before),
            Actions\ExportAction::make()
                ->exporter(UserExporter::class)
                ->label("Export Excel")
                ->color('primary')
                ->outlined()
                ->columnMapping(false)
                ->fileName(fn() => date('d-M-Y') . '-export-users')
                ->icon('heroicon-m-arrow-down-tray', IconPosition::Before),
        ];
    }
}
