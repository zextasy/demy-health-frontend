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
                Forms\Components\TextInput::make('test_category_id')
                    ->required(),
                Forms\Components\TextInput::make('specimen_type_id')
                    ->required(),
                Forms\Components\TextInput::make('test_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('minimum_tat')
                    ->required(),
                Forms\Components\TextInput::make('maximum_tat')
                    ->required(),
                Forms\Components\TextInput::make('price')
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
                Tables\Columns\TextColumn::make('test_category_id'),
                Tables\Columns\TextColumn::make('specimen_type_id'),
                Tables\Columns\TextColumn::make('test_id'),
                Tables\Columns\TextColumn::make('minimum_tat'),
                Tables\Columns\TextColumn::make('maximum_tat'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('description'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListTestTypes::route('/'),
            'create' => Pages\CreateTestType::route('/create'),
            'edit' => Pages\EditTestType::route('/{record}/edit'),
        ];
    }
}
