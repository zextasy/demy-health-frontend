<?php

namespace App\Filament\Pages;

use App\Models\Task;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use App\Actions\Tasks\StartTaskAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Actions\Tasks\RequestTaskCompletionConfirmationAction;

class TasksAssignedToMe extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Personal';

    protected static string $view = 'filament.pages.tasks-assigned-to-me';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
    }

    public function getTableQuery(): Builder
    {
        return Task::query()->where('assigned_to', auth()->user()->id);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('assignedBy.name'),
            TextColumn::make('assignedTo.name'),
            TextColumn::make('details'),
            TextColumn::make('assignable_name')
                ->label('Target')
                ->url(fn (Task $record): string => $record->assignable_url),
            TextColumn::make('due_at')
                ->dateTime(),
            TextColumn::make('status'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('start')
                ->action(fn (Task $record) => (new StartTaskAction)->run($record))
                ->requiresConfirmation()
                ->modalHeading('Start Task')
                ->modalSubheading('This will indicate that you have started this task')
                ->modalButton('Yes, start')
                ->visible(fn (Task $record): bool => auth()->user()->can('update', $record)),
            Action::make('markAsComplete')
                ->action(fn (Task $record) => (new RequestTaskCompletionConfirmationAction)->run($record))
                ->requiresConfirmation()
                ->modalHeading('Mark Task as Complete')
                ->modalSubheading('This will indicate that you have completed this task and it will be sent for approval')
                ->modalButton('Yes, mark')
                ->visible(fn (Task $record): bool => auth()->user()->can('update', $record)),
        ];
    }
}
