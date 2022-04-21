<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecimenTypeResource\Pages;
use App\Filament\Resources\SpecimenTypeResource\RelationManagers;
use App\Models\SpecimenType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SpecimenTypeResource extends Resource
{
    protected static ?string $model = SpecimenType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key'),
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
            'index' => Pages\ListSpecimenTypes::route('/'),
            'create' => Pages\CreateSpecimenType::route('/create'),
            'view' => Pages\ViewSpecimenType::route('/{record}'),
            'edit' => Pages\EditSpecimenType::route('/{record}/edit'),
        ];
    }
}
