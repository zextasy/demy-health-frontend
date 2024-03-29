<?php

namespace App\Filament\Resources\Finance\InvoiceResource\Pages;

use App\Filament\Resources\Finance\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
