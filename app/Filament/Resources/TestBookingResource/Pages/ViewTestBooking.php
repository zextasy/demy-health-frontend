<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use Filament\Pages\Actions\Action;
use App\Jobs\DeleteTestBookingJob;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Pages\EnterTestResultDetails;
use App\Filament\Resources\TestBookingResource;
use App\Filament\Actions\Pages\Tasks\AssignTaskAction;
use App\Filament\Actions\Pages\Orders\GenerateOrderForSingleItemAction;
use App\Filament\Actions\Pages\TestResults\UploadTestResultImageAction;

class ViewTestBooking extends ViewRecord
{
    protected static string $resource = TestBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            AssignTaskAction::make()->assignable($this->record),
            GenerateOrderForSingleItemAction::make('generate order')
                ->subject($this->record)
                ->visible($this->record->orderItems()->doesntExist()),
            UploadTestResultImageAction::make('upload result')
                ->subject($this->record)
                ->visible($this->record->testResultIsNotComplete()),
            Action::make('enter result details')
                ->url(EnterTestResultDetails::getUrl(['testBookingId' => $this->record->id]))
            ->visible($this->record->hasTestResultTemplate()),
            Action::make('delete')
                ->action(function (): void {
                    DeleteTestBookingJob::dispatch($this->record);
                    $this->notify('success', 'Booking and associated records will be deleted!');
                    $this->redirect(TestBookingResource::getUrl());
                })->color('danger')->requiresConfirmation()
        ];
    }
}
