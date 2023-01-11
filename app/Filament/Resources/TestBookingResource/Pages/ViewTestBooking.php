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

class ViewTestBooking extends ViewRecord
{
    protected static string $resource = TestBookingResource::class;

    protected function getActions(): array
    {
        return [
            AssignTaskAction::make()->assignable($this->record),
            Action::make('generate order')
                ->action(function (): void {
                    $order = (new GenerateOrderFromTestBookingAction)->run($this->record);
                    $this->notify('success', FlashMessageHelper::DEFAULT_SUCCESS_MESSAGE);
                    $this->redirect(OrderResource::getUrl('view', ['record' => $order->id]));
                })->requiresConfirmation()
                ->visible($this->record->orderItems()->doesntExist()),
            Action::make('upload result')
                ->action(function (array $data): void {
                    $testResult = (new GenerateTestResultAction)->withMediaUrls($data['result_file'])
                        ->withCustomerEmail($data['customer_email'])->run($this->record);
                    $this->notify('success', FlashMessageHelper::DEFAULT_SUCCESS_MESSAGE);
                    $this->redirect(TestResultResource::getUrl('view', ['record' => $testResult->id]));
                })->form([
                    Fieldset::make('General Info')->schema([
                        TextInput::make('reference')
                            ->maxLength(255)
                            ->unique(table: TestResult::class)
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
                            ->helperText(HelpTextMessageHelper::TEST_RESULT_CUSTOMER_EMAIL_MSG),
                    ]),
                ])
                ->visible($this->record->testResultIsNotComplete()),
            Action::make('delete')
                ->action(function (): void {
                    DeleteTestBookingJob::dispatch($this->record);
                    $this->notify('success', 'Booking and associated records will be deleted!');
                    $this->redirect(TestBookingResource::getUrl());
                })->color('danger')->requiresConfirmation()
        ];
    }
}
