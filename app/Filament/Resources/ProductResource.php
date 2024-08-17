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

    protected static ?string $label = "ပစ္စည်းများ";


    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('အမည်'),

                Select::make('category_id')
                    ->options(function (): array {
                        return Category::all()->pluck('name', 'id')->all();
                    })
                    ->required()
                    ->label('အမျိုးအစားများ')
                    ->searchable(),

                TextInput::make('starting_price')
                    ->required()
                    ->numeric()
                    ->label('စတင်မည့်စျေး'),

                TextInput::make('fixed_price')
                    ->required()
                    ->numeric()
                    ->label('ပုံသေစျေး'),

                DateTimePicker::make('start_datetime')
                    ->seconds(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->required()
                    ->native(false)
                    ->label('စတင်ရန် အချိန်'),

                DateTimePicker::make('end_datetime')
                    ->seconds(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->required()
                    ->native(false)
                    ->label('ပြီးဆုံးမည့်အချိန်'),

                TextInput::make('buyer_premium_percent')->required()->numeric(),

                TextInput::make('bid_increment')->required()->numeric()->label('လေလံတိုးနှုန်း'),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'finished' => 'Finished',
                    ])
                    ->required()
                    ->label('အခြေအနေ'),

                FileUpload::make('images')
                    ->multiple()
                    ->image()
                    ->maxFiles(10)
                    ->directory('product-images')
                    ->columnSpan('full')
                    ->label('ပုံထည့်ရန်'),

                RichEditor::make('description')->columnSpan(2)->required()->label('ဖော်ပြချက်'),

                RichEditor::make('delivery_option')->columnSpan(2)->required()
                ->label('ပို့ဆောင်မှုများ'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('အမည်')
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
                    ->label('အခြေအနေ')
                    ->selectablePlaceholder(false),

                TextColumn::make('start_datetime')
                    ->dateTime()
                    ->label('စတင်ရန် အချိန်'),

                TextColumn::make('end_datetime')
                    ->dateTime()
                    ->label('ပြီးဆုံးမည့်အချိန်'),

                TextColumn::make('starting_price')
                    ->numeric()
                    ->money('MMK')
                    ->badge()
                    ->color("success")
                    ->label('စတင်မည့်စျေး'),

                ImageColumn::make('images')
                    ->circular()
                    ->stacked()
                    ->label('ပုံများ'),

                TextColumn::make('created_at')
                    ->since()
                    ->badge()
                    ->color("info")
                    ->dateTime('d-M,y')
                    ->label('လွန်ခဲ့သောအချိန်က'),
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
                Tables\Actions\EditAction::make()->label('ပြင်ဆင်ရန်'),
                Tables\Actions\DeleteAction::make()->label('ဖျက်ရန်'),
                Tables\Actions\ViewAction::make()->label('ကြည့်ရှုရန်'),
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
