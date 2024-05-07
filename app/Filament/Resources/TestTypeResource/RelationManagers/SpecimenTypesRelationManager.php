<?php

namespace App\Filament\Resources\TestTypeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;

use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class SpecimenTypesRelationManager extends RelationManager
{
    protected static string $relationship = 'specimenTypes';

    protected static ?string $recordTitleAttribute = 'description';

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public function form(Form $form): Form
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

    public function table(Table $table): Table
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
