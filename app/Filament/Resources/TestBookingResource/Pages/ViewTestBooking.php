<?php

namespace App\Filament\Resources\TestBookingResource\Pages;

use App\Models\TestResult;
use Filament\Pages\Actions\Action;
use App\Jobs\DeleteTestBookingJob;
use App\Helpers\FlashMessageHelper;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\TestResultResource;
use App\Filament\Resources\TestBookingResource;
use App\Actions\TestResults\GenerateTestResultAction;
use App\Filament\Actions\Pages\Tasks\AssignTaskAction;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;
use App\Filament\Actions\Pages\Orders\GenerateOrderForSingleItemAction;
use App\Filament\Actions\Pages\TestResults\UploadTestResultImageAction;

class ViewTestBooking extends ViewRecord
{
    protected static string $resource = TestBookingResource::class;

    protected function getActions(): array
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
                ->url(TestResultResource::getUrl('enter-details', ['testBookingId' => $this->record->id])),
            Action::make('delete')
                ->action(function (): void {
                    DeleteTestBookingJob::dispatch($this->record);
                    $this->notify('success', 'Booking and associated records will be deleted!');
                    $this->redirect(TestBookingResource::getUrl());
                })->color('danger')->requiresConfirmation()
        ];
    }
}
