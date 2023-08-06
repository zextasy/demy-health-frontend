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
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public static function form(Form $form): Form
    {
		$users =  User::all()->pluck('name', 'id');
        return $form
            ->schema([
//                Forms\Components\Select::make('parent_id')->label('Parent')
//                    ->disabled()->placeholder('-'),
//                Forms\Components\Select::make('business_group_id')->label('Business Group')
//	                ->options($users)->disabled()->placeholder('-'),
                Forms\Components\Select::make('assigned_by')
	                ->options($users)
                    ->disabled()->placeholder('-'),
                Forms\Components\Select::make('assigned_to')
	                ->options($users)
                    ->disabled()->placeholder('-'),
	            Forms\Components\DateTimePicker::make('assigned_at')
		            ->disabled(),
	            Forms\Components\DateTimePicker::make('due_at')
		            ->disabled(),
	            Forms\Components\Textarea::make('details')
		            ->required()
		            ->maxLength(65535),
				Forms\Components\Fieldset::make('Status')->schema([
					Forms\Components\Select::make('started_by')->options($users)->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('started_at')->disabled(),
					Forms\Components\Select::make('completion_confirmation_requested_by')->options($users)
						->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('completion_confirmation_requested_at')->disabled(),
					Forms\Components\Select::make('completion_confirmation_confirmed_by')->options($users)
						->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('completion_confirmation_confirmed_at')->disabled(),
					Forms\Components\Select::make('completion_confirmation_rejected_by')
						->options($users)->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('completion_confirmation_rejected_at')->disabled(),
					Forms\Components\Select::make('completed_by')->options($users)->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('completed_at')->disabled(),
					Forms\Components\Select::make('failed_by')->options($users)->disabled()->placeholder('-'),
					Forms\Components\DateTimePicker::make('failed_at')->disabled(),
				]),
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
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
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
