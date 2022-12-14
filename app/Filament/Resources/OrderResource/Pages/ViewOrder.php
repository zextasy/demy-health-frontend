<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\OrderResource;
use App\Jobs\GenerateInvoiceFromOrderJob;
use App\Actions\Discounts\LinkDiscountableAction;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;


    protected function getActions(): array
    {
        return [
            Action::make('Apply Discount')
                ->action(function (array $data): void {
                    (new LinkDiscountableAction())
                        ->run($data['discount_id'], $this->record);
                })
                ->form([
                    Select::make('discount_id')
                        ->label('Discount')
                        ->options(Discount::all()->toSelectArray())
                        ->searchable()
                        ->required(),
                ])
                ->visible($this->record->hasNotBeenInvoiced()),
            Action::make('generate invoice')
                ->action(function (): void {
                    GenerateInvoiceFromOrderJob::dispatch($this->record);
                })->requiresConfirmation()
                ->visible($this->record->hasNotBeenInvoiced())
        ];
    }
}
