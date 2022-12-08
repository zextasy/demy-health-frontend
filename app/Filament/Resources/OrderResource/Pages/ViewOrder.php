<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\OrderResource;
use App\Jobs\GenerateInvoiceFromOrderJob;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;


    protected function getActions(): array
    {
        return [
            Action::make('generate invoice')
                ->action(function (): void {
                    GenerateInvoiceFromOrderJob::dispatch($this->record);
                })
                ->form([
                    Hidden::make('token'),
                ])
                ->visible($this->record->invoice()->doesntExist())
        ];
    }
}
