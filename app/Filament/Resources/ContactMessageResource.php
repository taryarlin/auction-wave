<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ContactMessage;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;

class ContactMessageResource extends Resource
{
    protected static ?int $navigationSort = 5;
    protected static ?string $model = ContactMessage::class;

    protected static ?string $label = "မက်ဆေ့ခ်ျများ";

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->options(function (): array {
                        return Customer::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->label('User (Our Customer)')
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('message')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('received_at'),
                Forms\Components\DateTimePicker::make('read_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('User')
                    ->searchable()
                    ->hidden(),
                Tables\Columns\TextColumn::make('name')
                    ->label('အမည်')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('အီးမေးလ်')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn (string $state) => strtolower($state)),
                Tables\Columns\TextColumn::make('message')
                    ->label('မက်ဆေ့ခ်ျများ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('received_at')
                    ->dateTime()
                    ->sortable()
                    ->hidden(),
                Tables\Columns\TextColumn::make('read_at')
                    ->dateTime()
                    ->sortable()
                    ->hidden(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received On')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->label('ကြည့်ရှုရန်'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make('delete')->label('ဖျက်ရန်'),
                Tables\Actions\ExportBulkAction::make('export')->label('Export Messages')->color('success'),
                ])
                ->label('လုပ်ဆောင်ချက်များ'),
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
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            // 'edit' => Pages\EditContactMessage::route('/{record}/edit'),
            // 'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
