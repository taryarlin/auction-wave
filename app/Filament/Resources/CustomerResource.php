<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\ActionGroup;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Hash;
use App\Services\Components\AppIcons;
use App\Filament\Exports\UserExporter;
use Filament\Support\Enums\ActionSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Modal\Actions\Action;
use App\Filament\Resources\CustomerResource\Pages;
use Filament\Tables\Actions\ExportBulkAction;

class CustomerResource extends Resource
{
    protected static ?int $navigationSort = 2;

    protected static ?string $label = "ဝယ်ယူသူများ";
    
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('အမည်'),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->label('အီးမေးလ်'),

                TextInput::make('password')
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->rule('regex:/[a-z]/')
                    ->rule('regex:/[A-Z]/')
                    ->rule('regex:/[0-9]/')
                    ->rule('regex:/[@$!%*?&]/')
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->label('စကားဝှက်'),

                TextInput::make('address')
                    ->required()
                    ->label('လိပ်စာ'),

                TextInput::make('phone')
                    ->required()
                    ->label('ဖုန်း'),

                DatePicker::make('date_of_birth')
                    ->maxDate(now())
                    ->closeOnDateSelection()
                    ->native(false)
                    ->label('မွေးနေ့'),

                FileUpload::make('profile')
                    ->image()
                    ->maxFiles(1)
                    ->directory('customer-images')
                    ->label('ပုံထည့်ရန်'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ImageColumn::make('profile')
                //     ->circular()
                //     ->defaultImageUrl(url('/images/placeholder.png')),

                TextColumn::make('name')->searchable()->sortable()->label('အမည်'),

                TextColumn::make('email')->searchable()->label('အီးမေးလ်'),

                TextColumn::make('phone')->searchable()->label('ဖုန်း'),

                TextColumn::make('address')
                    ->searchable()
                    ->label('လိပ်စာ')
                    ->badge()
                    ->color(function ($state) {
                        if (in_array($state, ['Yangon', 'Mandalay', 'Naypyitaw' , 'Nay Pyi Taw'])) {
                            return 'success';
                        }
                        return 'danger'; // or return a default color if needed
                    }),

                TextColumn::make('created_at')
                ->label('လွန်ခဲ့သောအချိန်က')
                    ->since()
                    ->badge()
                    ->color("info")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('ပြင်ဆင်ရန်'),
                Tables\Actions\DeleteAction::make()->label('ဖျက်ရန်'),
                Tables\Actions\ViewAction::make()->label('ကြည့်ရှုရန်'),
            ])
            ->bulkActions([
                ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
