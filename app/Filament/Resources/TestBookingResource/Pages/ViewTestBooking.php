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
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use App\Jobs\GenerateOrderFromBookingJob;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\TestBookingResource;
use App\Actions\TestResults\GenerateTestResultAction;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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
                        ->run($this->record, $data['assignedToId'], $data['details'], $dueAt);
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
                })->requiresConfirmation()
                ->visible($this->record->orderItems()->doesntExist()),
            Action::make('upload result')
                ->action(function (array $data): void {
                    ray($data);
                    (new GenerateTestResultAction)->withMediaUrls($data['result_file'])
                        ->withCustomerEmail($data['customer_email'])->run($this->record);
                })->form([
                    Fieldset::make('General Info')->schema([
                        TextInput::make('reference')
                            ->maxLength(255)
                            ->helperText('Leave this blank and the system will generate one for you'),
                    ])->columns(1),
                    Fieldset::make('Result')->schema([
                        FileUpload::make('result_file')
                            ->acceptedFileTypes(['application/pdf','image/*'])
                            ->multiple()
                            ->enableReordering(),
                    ])->columns(1),
                    Fieldset::make('Customer Details')->schema([
                        TextInput::make('customer_email')
                            ->email()
                            ->maxLength(255)
                            ->helperText('Leave this blank and the system will use the customer email from the booking'),
                    ]),
                ])
                ->visible($this->record->testResultIsNotComplete())

        ];
    }
}
