<?php

namespace App\Filament\Admin\Resources\Finance\PaymentResource\Pages;

use Filament\Pages\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\Finance\PaymentResource;

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
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }
}
