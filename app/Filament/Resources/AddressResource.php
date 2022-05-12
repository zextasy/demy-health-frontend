<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Address;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Locations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\BelongsToSelect::make('local_government_area_id')
                    ->relationship('localGovernmentArea', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('line_1')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('line_2')
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('localGovernmentArea.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('line_1')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('line_2')->searchable(),
                Tables\Columns\TextColumn::make('city')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestBookingsRelationManager::class,
            RelationManagers\TestCentersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            //            'create' => Pages\CreateAddress::route('/create'),
            'view' => Pages\ViewAddress::route('/{record}'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
