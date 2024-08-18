<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Winner;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Mail\AuctionWinnerMail;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WinnerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WinnerResource\RelationManagers;

class WinnerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $label = "လေလံအောင်မြင်သူများ";

    protected static ?string $navigationLabel = "လေလံအောင်မြင်သူများ";
    
    protected static ?string $navigationIcon = 'heroicon-o-users'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        // $winner = Customer::where('id', $record->id)->first();
        return $table
            ->columns([
                TextColumn::make('name')->label('အမည်'),

                TextColumn::make('email')->label('အီးမေးလ်')->badge()->color('success'),

                TextColumn::make('phone')->label('ဖုန်း')->badge()->color('danger'),

                TextColumn::make('product_name')
                    ->label('Product Name')
                    ->getStateUsing(function (Customer $record) {
                        return $record->won_product->name;
                    })
                    // ->searchable()
                    ->sortable()
                    ->label('ပစ္စည်းအမည်'),

                TextColumn::make('won_amount')
                    ->label('Won Amount')
                    ->getStateUsing(function (Customer $record) {
                        return number_format($record->won_product->won_amount) . ' MMK';
                    })
                    // ->searchable()
                    ->label('လေလံအနိုင်ရသည့်စျေး')
                    ->badge()->color('warning'),

                TextColumn::make('won_datetime')
                    ->label('Won Datetime')
                    ->getStateUsing(function (Customer $record) {
                        return $record->won_product->won_datetime;
                    })
                    // ->searchable()
                    ->label('လေလံအနိုင်ရသည့်အချိန်'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\Action::make('sendEmail')
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListWinners::route('/'),
            // 'create' => Pages\CreateWinner::route('/create'),
            // 'edit' => Pages\EditWinner::route('/{record}/edit'),
            'edit' => Pages\ViewWinner::route('/{record}'),
            // 'mail' => Pages\ViewWinner::route(''),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Winners';
    }

    public static function getModelLabel(): string
    {
        return 'Winner';
    }
}
