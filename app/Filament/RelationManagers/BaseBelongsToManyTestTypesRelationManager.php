<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BaseBelongsToManyTestTypesRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'testTypes';

    protected static ?string $recordTitleAttribute = 'test_id';

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Fieldset::make('Pricing')->schema([
                    Forms\Components\Toggle::make('should_call_in_for_details')
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
                        ->required(),
                ]),
                Fieldset::make('Description')->schema([
                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id')->sortable(),
                Tables\Columns\TextColumn::make('description')->sortable(),
                Tables\Columns\TextColumn::make('formatted_price')->label('price')->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('test_id');
    }
}
