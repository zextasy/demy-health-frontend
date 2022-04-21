<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocalGovernmentAreaResource\Pages;
use App\Filament\Resources\LocalGovernmentAreaResource\RelationManagers;
use App\Models\LocalGovernmentArea;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LocalGovernmentAreaResource extends Resource
{
    protected static ?string $model = LocalGovernmentArea::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name'),
                Tables\Columns\TextColumn::make('name'),

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
            'index' => Pages\ListLocalGovernmentAreas::route('/'),
            'create' => Pages\CreateLocalGovernmentArea::route('/create'),
            'edit' => Pages\EditLocalGovernmentArea::route('/{record}/edit'),
        ];
    }
}
