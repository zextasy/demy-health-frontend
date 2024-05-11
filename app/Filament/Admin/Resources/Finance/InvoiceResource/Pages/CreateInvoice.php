<?php

namespace App\Filament\Admin\Resources\Finance\InvoiceResource\Pages;

use App\Filament\Admin\Resources\Finance\InvoiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;
}
