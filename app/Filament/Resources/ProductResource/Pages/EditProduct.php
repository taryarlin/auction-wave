<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;
use App\Filament\Resources\ProductResource;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = "ပစ္စည်းများပြင်ဆင်ရန်";


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('ဖျက်ရန်')->icon('heroicon-m-trash', IconPosition::Before),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Product updated')
            ->body('The product has been saved successfully.')
            ->sendToDatabase(\auth()->user());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');  // Redirects to the customer list
    }
}
