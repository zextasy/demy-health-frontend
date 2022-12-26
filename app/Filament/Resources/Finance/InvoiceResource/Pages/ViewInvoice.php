<?php

namespace App\Filament\Resources\Finance\InvoiceResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Actions\Payments\CreatePaymentAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\Finance\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Capture Payment')
                ->action(function (array $data): void {
                    (new CreatePaymentAction)
                        ->withInternalReferences($this->record->reference)
                        ->paidBy($this->record->customer)
                        ->run($data['amount'], $data['method']);
                    $this->notify('success', 'Success!');
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
                    //                    DateTimePicker::make('received_at')
                    //                        ->minDate(now())
                    //                        ->withoutSeconds()
                    //                        ->required(),
                ]),
        ];
    }
}
