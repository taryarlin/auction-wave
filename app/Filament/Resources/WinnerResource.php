<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Winner;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WinnerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WinnerResource\RelationManagers;

class WinnerResource extends Resource
{
    protected static ?string $model = Customer::class;

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
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),

                TextColumn::make('email')->searchable(),

                TextColumn::make('phone')->searchable(),

                TextColumn::make('product_name')
                    ->label('Product Name')
                    ->getStateUsing(function (Customer $record) {
                        return $record->won_product->name;
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('won_amount')
                    ->label('Won Amount')
                    ->getStateUsing(function (Customer $record) {
                        return number_format($record->won_product->won_amount) . ' MMK';
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('won_datetime')
                    ->label('Won Datetime')
                    ->getStateUsing(function (Customer $record) {
                        return $record->won_product->won_datetime;
                    })
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
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
