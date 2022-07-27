<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\MorphManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BasePricesRelationManager extends MorphManyRelationManager
{
    protected static string $relationship = 'prices';

    protected static ?string $recordTitleAttribute = 'amount';

    protected static ?string $title = 'Price History';

    protected function canCreate(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canAttach(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                Fieldset::make('Pricing')->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->withoutTime(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')->money('ngn')->label('Price')->sortable(),
                Tables\Columns\TextColumn::make('start_date')->label('From')->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')->label('To')->date()->sortable(),
            ])
            ->filters([
                //
            ])->actions([]);
    }
}
