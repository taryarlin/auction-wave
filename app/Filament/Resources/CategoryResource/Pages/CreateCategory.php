<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Category created')
            ->body('The category has been created successfully.')
            ->sendToDatabase(\auth()->user());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');  // Redirects to the customer list
    }
}
