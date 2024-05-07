<?php

namespace App\Filament\Resources\Finance\DiscountResource\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use App\Actions\Discounts\UpdateDiscountAction;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Filament\Resources\Finance\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiscount extends EditRecord
{
    protected static string $resource = DiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('discount_value')
                    ->numeric()
                    ->required(),
            ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $discountCode = $data['code'];
        $name = $data['name'];
        $value = $data['discount_value'];
        return (new UpdateDiscountAction)->withCode($discountCode)->withName($name)->run($record, $value);
    }
}
