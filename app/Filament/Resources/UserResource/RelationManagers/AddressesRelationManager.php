<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class AddressesRelationManager extends MorphToManyRelationManager
{
    protected static string $relationship = 'Addresses';

    protected static ?string $recordTitleAttribute = 'line_1';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('line_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('line_2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
                Forms\Components\BelongsToSelect::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\BelongsToSelect::make('local_government_area_id')
                    ->relationship('localGovernmentArea', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name')->sortable(),
                Tables\Columns\TextColumn::make('localGovernmentArea.name')->sortable(),
                Tables\Columns\TextColumn::make('line_1')->sortable(),
                Tables\Columns\TextColumn::make('line_2')->sortable(),
                Tables\Columns\TextColumn::make('city')->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at','desc');
    }
}
