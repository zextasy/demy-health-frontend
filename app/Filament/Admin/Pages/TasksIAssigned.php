<?php

namespace App\Filament\Admin\Pages;

use App\Constants\NavigationGroupConstants;
use App\Models\Task;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ViewAction;
use App\Filament\Admin\Resources\TaskResource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Support\Filament\FilamentSharedTableFieldsGenerator;
use App\Actions\Tasks\RejectTaskCompletionConfirmationAction;
use App\Actions\Tasks\ApproveTaskCompletionConfirmationAction;

class TasksIAssigned extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = NavigationGroupConstants::PERSONAL;

    protected static string $view = 'filament.pages.tasks-i-assigned';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
    }

    public function getTableQuery(): Builder
    {
        return Task::query()->where('assigned_by', auth()->user()->id);
    }

    protected function getTableColumns(): array
    {
        return FilamentSharedTableFieldsGenerator::getTaskTable();
    }

    protected function getTableActions(): array
    {
        return [
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
	        Action::make('view')
		        ->url(fn (Task $record): string => TaskResource::getUrl('view', $record)),
        ];
    }
}
