<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?int $navigationSort = 4;
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->options(function (): array {
                        return Category::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->label('Category')
                    ->searchable(),

                TextInput::make('starting_price')
                    ->required()
                    ->numeric(),

                TextInput::make('fixed_price')
                    ->required()
                    ->numeric(),

                DateTimePicker::make('start_datetime')
                    ->seconds(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->required()
                    ->native(false),

                DateTimePicker::make('end_datetime')
                    ->seconds(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->required()
                    ->native(false),

                TextInput::make('buyer_premium_percent')->required()->numeric(),

                TextInput::make('bid_increment')->required()->numeric(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'finished' => 'Finished',
                    ])
                    ->required(),

                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->maxFiles(10)
                    ->directory('product-images')
                    ->columnSpan('full'),

                RichEditor::make('description')->columnSpan(2)->required(),

                RichEditor::make('delivery_option')->columnSpan(2)->required()
                ->label('Delivery Description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        $color = "rgb(234 179 8)";

                        if($record->status == 'approved') {
                            $color = 'rgb(22 163 74)';
                        }

                        if($record->status == 'rejected') {
                            $color = 'rgb(220 38 38)';
                        }

                        if($record->status == 'finished') {
                            $color = 'rgb(0, 179, 255)';
                        }

                        return '<span class="inline-block w-3 h-3 me-3 rounded-full" style="background: ' . $color . ';"></span> ' . $record->name;
                    })
                    ->html(),

                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'finished' => 'Finished',
                    ])
                    ->selectablePlaceholder(false),

                TextColumn::make('start_datetime')
                    ->dateTime(),

                TextColumn::make('end_datetime')
                    ->dateTime(),

                TextColumn::make('starting_price')
                    ->numeric()
                    ->money('MMK')
                    ->badge()
                    ->color("success"),

                ImageColumn::make('images')
                    ->circular()
                    ->stacked(),

                TextColumn::make('created_at')
                    ->since()
                    ->badge()
                    ->color("info")
                    ->dateTime('d-M,y')
            ])
            ->filters([
                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'finished' => 'Finished',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
