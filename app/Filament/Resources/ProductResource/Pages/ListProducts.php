<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Support\Enums\IconPosition;
use App\Filament\Exports\ProductExporter;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProductResource;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->color('primary')
                ->label('ပစ္စည်းများအသစ်ထည့်ရန်')
                ->outlined()
                ->icon('heroicon-m-folder-plus', IconPosition::Before),
            Actions\ExportAction::make()
                ->exporter(ProductExporter::class)
                ->label("Export Excel")
                ->color('primary')
                ->outlined()
                ->columnMapping(false)
                ->fileName(fn() => date('d-M-Y') . '-export-products')
                ->icon('heroicon-m-arrow-down-tray', IconPosition::Before)
        ];
    }
}
