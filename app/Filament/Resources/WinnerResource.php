<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Winner;
use App\Models\Product;
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
    protected static ?string $model = Product::class;

    protected static ?string $label = "လေလံအောင်မြင်သူများ";

    protected static ?string $navigationLabel = "အောင်မြင်သူများ";
    
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
                TextColumn::make('winner_name')
                    ->label('လေလံအနိုင်အရသူ အမည်')
                    ->getStateUsing(function (Product $record) {
                        return $record->winner->name;
                    })
                    ->sortable(),

                TextColumn::make('winner_phone')
                    ->label('လေလံအနိုင်အရသူ ဖုန်း')
                    ->getStateUsing(function (Product $record) {
                        return $record->winner->phone;
                    })
                    ->sortable()
                    ->badge()->color('danger'),

                TextColumn::make('winner_email')
                    ->label('လေလံအနိုင်အရသူ အီးမေးလ်')
                    ->getStateUsing(function (Product $record) {
                        return $record->winner->email;
                    })
                    ->sortable()
                    ->badge()->color('success'),

                TextColumn::make('name')
                    ->label('ပစ္စည်းအမည်')
                    ->searchable()->sortable(),
                TextColumn::make('won_amount')
                    ->getStateUsing(function (Product $record) {
                        return number_format($record->won_amount) . ' MMK';
                    })
                    ->searchable()
                    ->label('လေလံအနိုင်ရသည့်စျေး')
                    ->badge()->color('warning'),
                TextColumn::make('won_datetime')
                    ->label('လေလံအနိုင်ရသည့်အချိန်')
                    ->searchable()->sortable(),
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
