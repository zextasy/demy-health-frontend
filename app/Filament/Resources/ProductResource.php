<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Pictures')->schema([
                    SpatieMediaLibraryFileUpload::make('pictures')
                        ->image()
                        ->multiple()
                        ->enableReordering(),
                ])->columns(1),
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('model')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('country')
                        ->maxLength(255),
                    Forms\Components\BelongsToManyMultiSelect::make('categories')
                        ->relationship('categories', 'name')
                ]),
                Forms\Components\Fieldset::make('Pricing')->schema([
                    Forms\Components\Toggle::make('should_call_in_for_details')
                        ->required(),
                    Forms\Components\TextInput::make('price'),
                ]),
                Forms\Components\Fieldset::make('Extra Info')->schema([
                    Forms\Components\KeyValue::make('extra_information'),
                ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('formatted_price')->label('price'),
                Tables\Columns\TextColumn::make('extra_information'),

            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}