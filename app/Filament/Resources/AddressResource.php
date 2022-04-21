<?php

namespace App\Filament\Resources;

use App\Models\State;
use App\Models\LocalGovernmentArea;
use App\Filament\Resources\AddressResource\Pages;
use App\Filament\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                Forms\Components\TextInput::make('addressable_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('addressable_id')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('state.name'),
                Tables\Columns\TextColumn::make('localGovernmentArea.name'),
                Tables\Columns\TextColumn::make('line_1'),
                Tables\Columns\TextColumn::make('line_2'),
                Tables\Columns\TextColumn::make('city')
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
            'index' => Pages\ListAddresses::route('/'),
//            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
