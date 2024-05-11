<?php

namespace App\Filament\Admin\Resources\Finance\DiscountResource\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Actions\Discounts\CreateDiscountAction;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Filament\Admin\Resources\Finance\DiscountResource;

class CreateDiscount extends CreateRecord
{
    protected static string $resource = DiscountResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $discountTypeEnum = DiscountTypeEnum::from($data['type']);
        $discountCode = $data['code'];
        $name = $data['name'];
        $value = $data['discount_value'];
        return (new CreateDiscountAction)->run($discountTypeEnum, $discountCode, $name, $value);
    }
}
