<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Admin\Resources\OrderResource;
use App\Jobs\GenerateInvoiceFromOrderJob;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Filament\Admin\Resources\Finance\InvoiceResource;
use App\Actions\Invoices\GenerateInvoiceForOrderAction;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Action::make('Apply Discount')
                ->action(function (array $data): void {
                    (new LinkDiscountableAction())
                        ->run($data['discount_id'], $this->record);
                    $this->notify('success', 'Success!');
                    $this->redirect(OrderResource::getUrl('view', ['record' => $this->record->id]));
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
                    $invoice = (new GenerateInvoiceForOrderAction)->run($this->record);
                    $this->notify('success', 'Success!');
                    $this->redirect(InvoiceResource::getUrl('view', ['record' => $invoice->id]));
                })->requiresConfirmation()
                ->visible($this->record->hasNotBeenInvoiced())
        ];
    }
}
