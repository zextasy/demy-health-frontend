<?php

namespace App\Filament\Resources;

use App\Models\LocalGovernmentArea;
use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Locations';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Fieldset::make('Sample Collection')->schema([
                    Forms\Components\Toggle::make('is_ready_for_sample_collection')
                        ->disabled(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\BooleanColumn::make('is_ready_for_sample_collection')->sortable(),
                Tables\Columns\TextColumn::make('local_government_areas_count')
                    ->counts('localGovernmentAreas')
                    ->label('LGAs')
                    ->sortable(),
            ])
            ->filters([
                //
            ])->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LocalGovernmentAreasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'view' => Pages\ViewState::route('/{record}'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
