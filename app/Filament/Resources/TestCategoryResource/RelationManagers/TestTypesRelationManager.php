<?php

namespace App\Filament\Resources\TestCategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class TestTypesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'testTypes';

    protected static ?string $recordTitleAttribute = 'test_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_id')
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
                        ->required()
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
