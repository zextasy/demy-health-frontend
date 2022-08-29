<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('parent_id'),
                Forms\Components\TextInput::make('business_group_id')
                    ->required(),
                Forms\Components\TextInput::make('assigned_by')
                    ->required(),
                Forms\Components\TextInput::make('assigned_to')
                    ->required(),
                Forms\Components\TextInput::make('started_by'),
                Forms\Components\TextInput::make('completion_confirmation_requested_by'),
                Forms\Components\TextInput::make('completion_confirmation_confirmed_by'),
                Forms\Components\TextInput::make('completion_confirmation_rejected_by'),
                Forms\Components\TextInput::make('completed_by'),
                Forms\Components\TextInput::make('failed_by'),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('due_at')
                    ->required(),
                Forms\Components\TextInput::make('assignable_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('assignable_id')
                    ->required(),
                Forms\Components\Textarea::make('assignable_url')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('assigned_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('started_at'),
                Forms\Components\DateTimePicker::make('completion_confirmation_requested_at'),
                Forms\Components\DateTimePicker::make('completion_confirmation_confirmed_at'),
                Forms\Components\DateTimePicker::make('completion_confirmation_rejected_at'),
                Forms\Components\DateTimePicker::make('completed_at'),
                Forms\Components\DateTimePicker::make('failed_at'),
                Forms\Components\Toggle::make('completion_rating'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent_id'),
                Tables\Columns\TextColumn::make('business_group_id'),
                Tables\Columns\TextColumn::make('assigned_by'),
                Tables\Columns\TextColumn::make('assigned_to'),
                Tables\Columns\TextColumn::make('started_by'),
                Tables\Columns\TextColumn::make('completion_confirmation_requested_by'),
                Tables\Columns\TextColumn::make('completion_confirmation_confirmed_by'),
                Tables\Columns\TextColumn::make('completion_confirmation_rejected_by'),
                Tables\Columns\TextColumn::make('completed_by'),
                Tables\Columns\TextColumn::make('failed_by'),
                Tables\Columns\TextColumn::make('details'),
                Tables\Columns\TextColumn::make('due_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('assignable_type'),
                Tables\Columns\TextColumn::make('assignable_id'),
                Tables\Columns\TextColumn::make('assignable_url'),
                Tables\Columns\TextColumn::make('assigned_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('started_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('completion_confirmation_requested_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('completion_confirmation_confirmed_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('completion_confirmation_rejected_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('failed_at')
                    ->dateTime(),
                Tables\Columns\BooleanColumn::make('completion_rating'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }    
}
