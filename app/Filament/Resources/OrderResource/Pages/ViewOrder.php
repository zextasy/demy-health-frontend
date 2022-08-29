<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Illuminate\Support\Carbon;
use Filament\Pages\Actions\Action;
use App\Actions\CreatePaymentAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;


    protected function getActions(): array
    {
        return [
            Action::make('capture Payment')
                ->action(function (array $data): void {
                    (new CreatePaymentAction)->execute($this->record,$data['amount'],$data['method']);
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
