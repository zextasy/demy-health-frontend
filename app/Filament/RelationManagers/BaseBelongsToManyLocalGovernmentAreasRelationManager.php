<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BaseBelongsToManyLocalGovernmentAreasRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'localGovernmentAreas';

    protected static ?string $recordTitleAttribute = 'name';

    protected function canCreate(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_ready_for_sample_collection')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\BooleanColumn::make('is_ready_for_sample_collection')->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
