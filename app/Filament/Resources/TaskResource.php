<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use App\Actions\Tasks\StartTaskAction;
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
use App\Actions\Tasks\RejectTaskCompletionConfirmationAction;
use App\Actions\Tasks\RequestTaskCompletionConfirmationAction;
use App\Actions\Tasks\ApproveTaskCompletionConfirmationAction;
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
                TextColumn::make('actionable_name')
                    ->label('Result')
                    ->url(fn (Task $record): string => $record->actionable_url ?? '#'),
                TextColumn::make('due_at')
                    ->dateTime(),
                TextColumn::make('status'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Action::make('start')
                    ->action(fn (Task $record) => (new StartTaskAction)->run($record))
                    ->requiresConfirmation()
                    ->modalHeading('Start Task')
                    ->modalSubheading('This will indicate that you have started this task')
                    ->modalButton('Yes, start')
                    ->visible(fn (Task $record): bool => auth()->user()->can('start', $record) && $record->canBeStarted()),
                Action::make('markAsComplete')
                    ->action(fn (Task $record) => (new RequestTaskCompletionConfirmationAction)->run($record))
                    ->requiresConfirmation()
                    ->modalHeading('Mark Task as Complete')
                    ->modalSubheading('This will indicate that you have completed this task and it will be sent for approval')
                    ->modalButton('Yes, mark')
                    ->visible(fn (Task $record): bool => auth()->user()->can('requestCompletionConfirmation', $record) && $record->canBeCompleted()),
                Action::make('confirmCompletion')
                    ->action(fn (Task $record) => (new ApproveTaskCompletionConfirmationAction())->run($record))
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Task is Complete')
                    ->modalSubheading('This will indicate that you have reviewed this task and are satisfied')
                    ->modalButton('Yes, confirm')
                    ->visible(fn (Task $record): bool => auth()->user()->can('reviewCompletionRequest', $record)),
                Action::make('rejectCompletion')
                    ->action(fn (Task $record, array $data) => (new RejectTaskCompletionConfirmationAction())->run($record, $data['markAsFailed'])
                    )
                    ->form([
                        Toggle::make('markAsFailed')
                            ->label('mark as failed')
                            ->required()
                            ->helperText('This task will be marked as failed if you select this option '),
                    ])
                    ->visible(fn (Task $record): bool => auth()->user()->can('reviewCompletionRequest', $record)),
                Tables\Actions\ViewAction::make(),
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
