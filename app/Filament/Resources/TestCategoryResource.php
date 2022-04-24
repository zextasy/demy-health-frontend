<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestCategoryResource\Pages;
use App\Filament\Resources\TestCategoryResource\RelationManagers;
use App\Models\TestCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestCategoryResource extends Resource
{
    protected static ?string $model = TestCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),

            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestTypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestCategories::route('/'),
            'create' => Pages\CreateTestCategory::route('/create'),
            'view' => Pages\ViewTestCategory::route('/{record}'),
            'edit' => Pages\EditTestCategory::route('/{record}/edit'),
        ];
    }
}
