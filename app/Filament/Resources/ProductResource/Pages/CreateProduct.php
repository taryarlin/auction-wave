<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Models\Product;
use App\Models\ProductImage;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected static bool $canCreateAnother = false; 
    protected static ?string $title = "ပစ္စည်းများ အသစ်ထည့်ရန်";

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['ownerable_type'] = get_class(auth()->user());
        $data['ownerable_id'] = auth()->id();

        return $data;
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Product created')
            ->body('The product has been created successfully.')
            ->sendToDatabase(\auth()->user());
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');  // Redirects to the customer list
    }
    // protected function handleRecordCreation(array $data): Product
    // {
    //     $saveable = collect($data)->except('images')->toArray();
    //     $record = new ($this->getModel())($saveable);

    //     $record->save();

    //     if(isset($data['images'])) {
    //         foreach($data['images'] as $image) {
    //             $default = $record->images()->exists() ? false : true;

    //             ProductImage::create([
    //                 'product_id' => $record->id,
    //                 'image' => $image,
    //                 'default' => $default
    //             ]);
    //         }
    //     }

    //     return $record;
    // }
}
