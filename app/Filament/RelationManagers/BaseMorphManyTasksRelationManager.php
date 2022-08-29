<?php

namespace App\Filament\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class BaseMorphManyTasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $recordTitleAttribute = 'details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('details')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('details'),
                TextColumn::make('assignedBy.name'),
                TextColumn::make('assignedTo.name'),
                TextColumn::make('due_at')
                    ->dateTime(),
                TextColumn::make('status'),
            ])
            ->defaultSort('id','desc')
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
    }
}
