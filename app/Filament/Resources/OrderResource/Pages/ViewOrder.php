<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Illuminate\Support\Carbon;
use Filament\Pages\Actions\Action;
use App\Actions\CreatePaymentAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;


    protected function getActions(): array
    {
        return [

        ];
    }
}
