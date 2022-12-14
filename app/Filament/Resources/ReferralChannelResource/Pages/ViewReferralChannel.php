<?php

namespace App\Filament\Resources\ReferralChannelResource\Pages;

use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Actions\Payments\CreatePaymentAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Actions\Discounts\LinkDiscounterAction;
use App\Filament\Resources\ReferralChannelResource;
use Filament\Resources\Pages\ViewRecord;

class ViewReferralChannel extends ViewRecord
{
    protected static string $resource = ReferralChannelResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Attach Discount')
                ->action(function (array $data): void {
                    (new LinkDiscounterAction)
                        ->run($data['discount_id'], $this->record);
                })
                ->form([
                    Select::make('discount_id')
                        ->label('Discount')
                        ->options(Discount::all()->toSelectArray())
                        ->searchable()
                        ->required(),
                ])
                ->visible($this->record->canApplyDiscount()),
        ];
    }
}
