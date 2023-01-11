<?php

namespace App\Filament\Actions\Pages\Tasks;

use App\Models\User;
use Illuminate\Support\Carbon;
use App\Helpers\FlashMessageHelper;
use Filament\Forms\Components\Select;
use App\Contracts\AssignableContract;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Actions\Pages\BasePageAction;
use App\Filament\Resources\TestBookingResource;

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
            ->successNotificationMessage(__('Copied to clipboard'))
            ->failureNotificationMessage(__('No data to copy'))
            ->icon('heroicon-o-inbox-in')
            ->mountUsing(fn (ComponentContainer $form) => $form->fill([
                'assignedById' => auth()->id(),
            ]))
            ->action(function (array $data): void {
                $dueAt = Carbon::parse($data['due_at']);
                (new \App\Actions\Tasks\AssignTaskAction)->assignedBy($data['assignedById'])
                    ->run($this->assignable, $data['assignedToId'], $data['details'], $dueAt);
                $this->redirect(TestBookingResource::getUrl('view', ['record' => $this->assignable->id]));
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

}
