<?php

namespace App\Filament\Resources;

use App\Settings\GeneralSettings;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class ProductResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Pictures')->schema([
                    SpatieMediaLibraryFileUpload::make('pictures')
                        ->image()
                        ->multiple()
                        ->collection('pictures')
                        ->enableReordering()
                        ->enableOpen(),
                ])->columns(1),
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('sku')
                        ->label('SKU')
                        ->unique()
                        ->maxLength(255)
                        ->helperText('Leave this blank and the system will generate one for you'),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('model')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('country')
                        ->maxLength(255),
                    Forms\Components\BelongsToManyMultiSelect::make('categories')
                        ->relationship('productCategories', 'name'),
                ]),
                Forms\Components\Fieldset::make('Pricing')->schema([
                    Forms\Components\Toggle::make('should_call_in_for_details')
                        ->required(),
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
                SpatieMediaLibraryImageColumn::make('picture')->collection('pictures'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('model')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('country')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->money(self::getSystemDefaultCurrency())->sortable(),
                Tables\Columns\TextColumn::make('extra_information')->searchable(),

            ])
            ->filters([
                //
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PricesRelationManager::class,
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
