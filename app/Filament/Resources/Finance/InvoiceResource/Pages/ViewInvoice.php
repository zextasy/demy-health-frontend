<?php

namespace App\Filament\Resources\Finance\InvoiceResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use Filament\Pages\Actions\ActionGroup;
use Filament\Forms\Components\TextInput;
use App\Helpers\NotificationStatusHelper;
use App\Actions\Payments\CreatePaymentAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\Finance\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Actions\Payments\AttachPaymentToPayablesAction;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('New Payment')
                    ->action(function (array $data): void {
                        $result = (new CreatePaymentAction)
                            ->withInternalReferences($this->record->reference)
                            ->paidBy($this->record->activeCustomer)
                            ->withCustomerEmail($this->record->customer_email)
                            ->run($data['amount'], $data['method']);
                        $message = isset($result) ?
                            HelpTextMessageHelper::DEFAULT_SUCCESS_MESSAGE
                            : HelpTextMessageHelper::DEFAULT_ERROR_MESSAGE;
                        $status = isset($result) ?
                            NotificationStatusHelper::SUCCESS
                            : NotificationStatusHelper::ERROR;
                        $this->notify($status, $message);
                        $this->redirect(InvoiceResource::getUrl('view', ['record' => $this->record->id]));
                    })
                    ->form([
                        TextInput::make('amount')
                            ->label('Amount')
                            ->numeric()
                            ->required(),
                        Select::make('method')
                            ->label('Payment Method')
                            ->options(PaymentMethodEnum::optionsAsSelectArray())
                            ->searchable()
                            ->required(),
                    ])
                    ->visible($this->record->hasNotBeenSettled()),
                Action::make('Attach Payment')
                    ->action(function (array $data): void {
                        $result = (new AttachPaymentToPayablesAction)
                            ->run($data['payment_id'], $this->record);
                        $message = $result ?
                            HelpTextMessageHelper::DEFAULT_SUCCESS_MESSAGE
                            : HelpTextMessageHelper::DEFAULT_ERROR_MESSAGE;
                        $status = $result ?
                            NotificationStatusHelper::SUCCESS
                            : NotificationStatusHelper::ERROR;
                        $this->notify($status, $message);
                        $this->redirect(InvoiceResource::getUrl('view', ['record' => $this->record->id]));
                    })
                    ->form([
                        Select::make('payment_id')
                            ->label('Payment')
                            ->options($this->record->getApplicablePayments()?->toSelectArray('name_for_select'))
                            ->required(),
                    ])
                    ->visible($this->record->hasNotBeenSettled()),
            ])->icon('heroicon-s-cash')->label('Finance'),
        ];
    }
}
