<?php

namespace App\Filament\Resources\TestTypeResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SpecimenTypesRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'specimenTypes';

    protected static ?string $recordTitleAttribute = 'description';

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
                Tables\Columns\TextColumn::make('key')->sortable(),
                Tables\Columns\TextColumn::make('description')->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('key');
    }
}
