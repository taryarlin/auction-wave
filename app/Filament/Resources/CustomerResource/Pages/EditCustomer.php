<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CustomerResource;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Customer updated')
            ->body('The customer has been saved successfully.')
            ->sendToDatabase(\auth()->user());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');  // Redirects to the customer list
    }
}
