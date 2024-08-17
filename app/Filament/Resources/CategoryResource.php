<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?int $navigationSort = 3;
    protected static ?string $model = Category::class;

    protected static ?string $label = "အမျိုးအစားများ";

    protected static ?string $navigationLabel = "အမျိုးအစားများ";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2)
                    ->label('အမည်'),

                FileUpload::make('image')
                    ->required()
                    ->directory('project')
                    ->imageEditor()
                    ->columnSpan(2)
                    ->label('ပုံထည့်ရန်'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('အမည်'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('ပြင်ဆင်ရန်'),
                Tables\Actions\DeleteAction::make()->label('ဖျက်ရန်'),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
