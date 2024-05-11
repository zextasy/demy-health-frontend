<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AddressResource\Pages;
use App\Filament\Admin\Resources\AddressResource\RelationManagers;
use App\Models\Address;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Locations';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

//    public static function canCreate(): bool
//    {
//        return auth()->user()->isFilamentAdmin();
//    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('state_id')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('local_government_area_id', null))
                    ->required(),
                Forms\Components\Select::make('local_government_area_id')
                    ->label('local Government Area')
                    ->options(function (callable $get) {
                        $state = State::find($get('state_id'));
                        if (! $state) {
                            return [];
                        }

                        return $state->localGovernmentAreas->toSelectArray();
                    })
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
