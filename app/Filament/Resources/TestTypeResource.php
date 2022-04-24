<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestTypeResource\Pages;
use App\Filament\Resources\TestTypeResource\RelationManagers;
use App\Models\TestType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestTypeResource extends Resource
{
    protected static ?string $model = TestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\BelongsToSelect::make('test_category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('should_call_in_for_details')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('minimum_tat')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('maximum_tat')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('formatted_price')->label('price'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('tat'),



            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SpecimenTypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestTypes::route('/'),
            'create' => Pages\CreateTestType::route('/create'),
            'view' => Pages\ViewTestType::route('/{record}'),
            'edit' => Pages\EditTestType::route('/{record}/edit'),
        ];
    }
}
