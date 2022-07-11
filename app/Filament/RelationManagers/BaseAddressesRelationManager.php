<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use App\Models\State;
use Filament\Resources\Form;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BaseAddressesRelationManager extends MorphToManyRelationManager
{
    protected static string $relationship = 'Addresses';

    protected static ?string $recordTitleAttribute = 'line_1';

    protected function canCreate(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canDetach(Model $record): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canEdit(Model $record): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

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
                Forms\Components\Select::make('state_id')
                    ->label('State')
                    ->options(State::all()->toSelectArray())
                    ->reactive()
                    ->afterStateUpdated(fn( callable $set) => $set('local_government_area_id', null))
                    ->required(),
                Forms\Components\Select::make('local_government_area_id')
                    ->label('Local Government Area')
                    ->options(function (callable $get) {
                        $state = State::find($get('state_id'));
                        if (! $state){
                            return [];
                        }
                        return $state->localGovernmentAreas->toSelectArray();
                    })
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
            ->defaultSort('line_1','desc');
    }
}
