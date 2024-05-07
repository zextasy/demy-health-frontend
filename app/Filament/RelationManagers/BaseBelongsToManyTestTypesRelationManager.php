<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Fieldset;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class BaseBelongsToManyTestTypesRelationManager extends RelationManager
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

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id')->sortable(),
                Tables\Columns\TextColumn::make('description')->sortable(),
                Tables\Columns\TextColumn::make('price')->money('ngn')->sortable(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ])
            ->defaultSort('test_id');
    }
}
