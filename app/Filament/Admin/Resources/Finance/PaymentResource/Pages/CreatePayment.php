<?php

namespace App\Filament\Admin\Resources\Finance\PaymentResource\Pages;

use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Admin\Resources\Finance\PaymentResource;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('reference')
                ->unique()
                ->helperText(HelpTextMessageHelper::GENERAL_REFERENCE_HELP_TEXT)
                ->maxLength(255),
            Select::make('payment_method')
                ->options(PaymentMethodEnum::class)->required(),
            TextInput::make('amount')->required(),
        ];
    }
}
