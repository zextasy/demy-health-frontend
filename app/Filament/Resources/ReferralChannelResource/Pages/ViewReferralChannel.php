<?php

namespace App\Filament\Resources\ReferralChannelResource\Pages;

use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use App\Actions\Discounts\LinkDiscounterAction;
use App\Filament\Resources\ReferralChannelResource;

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
                    $this->notify('success', 'Success!');
                    $this->redirect(ReferralChannelResource::getUrl('view', ['record' => $this->record->id]));
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
