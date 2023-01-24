<?php

namespace App\Filament\Resources\Finance\PaymentResource\Pages;

use Filament\Pages\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Finance\PaymentResource;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('reference')
                ->unique()
                ->maxLength(255),
        ];
    }
    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}
