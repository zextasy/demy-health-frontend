<?php

namespace App\Filament\Admin\Resources\Finance\PaymentResource\Pages;

use App\Filament\Admin\Resources\Finance\PaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}