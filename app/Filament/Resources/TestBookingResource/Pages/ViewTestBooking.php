<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Models\User;
use Illuminate\Support\Carbon;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Textarea;
use App\Actions\Tasks\AssignTaskAction;
use Filament\Resources\Pages\ViewRecord;
use App\Jobs\GenerateOrderFromBookingJob;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TestBookingResource;

class ViewTestBooking extends ViewRecord
{
    protected static string $resource = TestBookingResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('assign task')
                ->mountUsing(fn (ComponentContainer $form) => $form->fill([
                'assignedById' => auth()->id(),
            ]))
                ->action(function (array $data): void {
                    $dueAt = Carbon::parse($data['due_at']);
                    (new AssignTaskAction)->assignedBy($data['assignedById'])
                        ->execute($this->record, $data['assignedToId'], $data['details'], $dueAt);
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
                ]),
            Action::make('generate order')
                ->action(function (): void {
                    GenerateOrderFromBookingJob::dispatch($this->record);
                })
                ->form([
                    Hidden::make('token'),
                ])
                ->visible($this->record->orderItems()->doesntExist())
        ];
    }
}
