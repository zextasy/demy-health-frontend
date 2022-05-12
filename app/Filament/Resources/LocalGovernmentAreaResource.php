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

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Locations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\BelongsToSelect::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),

            ])
            ->filters([
                //
            ])
            ->defaultSort('name');
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
            'view' => Pages\ViewLocalGovernmentArea::route('/{record}'),
            'edit' => Pages\EditLocalGovernmentArea::route('/{record}/edit'),
        ];
    }
}
