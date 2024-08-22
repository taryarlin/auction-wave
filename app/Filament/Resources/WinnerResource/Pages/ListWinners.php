<?php

namespace App\Filament\Resources\WinnerResource\Pages;

use Filament\Actions;
use App\Models\Product;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WinnerResource;

class ListWinners extends ListRecords
{
    protected static string $resource = WinnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return parent::getTableQuery()->whereNotNull(['winner_id', 'won_amount', 'won_datetime']);
    }   
}
