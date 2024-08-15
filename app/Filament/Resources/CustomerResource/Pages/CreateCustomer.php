<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions;
use App\Filament\Exports\UserExporter;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Actions\ExportAction;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CustomerResource;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

 
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.')
            ->sendToDatabase(\auth()->user());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');  // Redirects to the customer list
    }
}
