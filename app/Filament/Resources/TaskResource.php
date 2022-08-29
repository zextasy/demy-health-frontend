<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables\Columns\TextColumn;
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
                Forms\Components\Select::make('parent_id')->label('Parent')
                    ->disabled(),
                Forms\Components\Select::make('business_group_id')->label('Business Group')
                    ->disabled(),
                Forms\Components\Select::make('assigned_by')
                    ->disabled(),
                Forms\Components\Select::make('assigned_to')->options(User::all()->pluck('name','id'))
                    ->required(),
                Forms\Components\TextInput::make('started_by'),
                Forms\Components\TextInput::make('completion_confirmation_requested_by')->disabled(),
                Forms\Components\TextInput::make('completion_confirmation_confirmed_by')->disabled(),
                Forms\Components\TextInput::make('completion_confirmation_rejected_by')->disabled(),
                Forms\Components\TextInput::make('completed_by')->disabled(),
                Forms\Components\TextInput::make('failed_by')->disabled(),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('due_at')
                    ->required(),
                Forms\Components\Textarea::make('assignable_url')
                    ->disabled()
                    ->maxLength(65535),
                Forms\Components\DateTimePicker::make('assigned_at')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('started_at')->disabled(),
                Forms\Components\DateTimePicker::make('completion_confirmation_requested_at')->disabled(),
                Forms\Components\DateTimePicker::make('completion_confirmation_confirmed_at')->disabled(),
                Forms\Components\DateTimePicker::make('completion_confirmation_rejected_at')->disabled(),
                Forms\Components\DateTimePicker::make('completed_at')->disabled(),
                Forms\Components\DateTimePicker::make('failed_at')->disabled(),
                Forms\Components\Toggle::make('completion_rating')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                TextColumn::make('business_group.name'),
                TextColumn::make('assignedBy.name'),
                TextColumn::make('assignedTo.name'),
                TextColumn::make('details'),
                TextColumn::make('assignable_name')
                    ->label('Target')
                    ->url(fn (Task $record): string => $record->assignable_url),
                TextColumn::make('due_at')
                    ->dateTime(),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
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
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
