<?php

namespace App\Filament\Actions\Pages\Tasks;

use App\Models\User;
use Illuminate\Support\Carbon;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use App\Contracts\AssignableContract;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Actions\Pages\BasePageAction;

class AssignTaskAction extends BasePageAction
{
    private ?AssignableContract $assignable = null;

    public static function getDefaultName(): ?string
    {
        return 'assign task';
    }

    public function setUp(): void
    {
        parent::setUp();

        $this
            ->successRedirectUrl(Filament::getUrl())
            ->successNotification(Notification::make()
                ->title('Success!')
                ->success())
            ->failureNotification(Notification::make()
                ->title('Something went wrong')
                ->danger())
            ->icon('heroicon-o-inbox-in')
            ->mountUsing(fn (ComponentContainer $form) => $form->fill([
                'assignedById' => auth()->id(),
            ]))
            ->action(function (array $data): void {
                $this->runAction($data) ? $this->success() : $this->failure();
            })
            ->form([
                Select::make('assignedById')
                    ->label('Assigned by')
                    ->options(User::query()->pluck('name', 'id'))
                    ->disabled(),
                Select::make('assignedToId')
                    ->label('Assigned To')
                    ->options(User::query()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Textarea::make('details')
                    ->required()
                    ->maxLength(512),
                DateTimePicker::make('due_at')
                    ->minDate(now())
                    ->withoutSeconds()
                    ->required(),
            ]);
    }


    public function assignable(AssignableContract $assignable): self
    {
        $this->assignable = $assignable;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            $dueAt = Carbon::parse($data['due_at']);
            (new \App\Actions\Tasks\AssignTaskAction)->assignedBy($data['assignedById'])
                ->run($this->assignable, $data['assignedToId'], $data['details'], $dueAt);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

}
