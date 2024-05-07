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
use App\Filament\Actions\Pages\Payments\CapturePaymentAction;
use App\Filament\Actions\Pages\Payments\AttachExistingPaymentAction;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                CapturePaymentAction::make()->payer($this->record->activeCustomer)
                    ->creditable($this->record)->visible($this->record->hasNotBeenSettled()),
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
            ])->icon('heroicon-m-banknotes')->label('Finance'),
        ];
    }
}
