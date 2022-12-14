<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Models\TestType;
use App\Models\TestCenter;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\PatientResource;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Actions\Discounts\LinkDiscounterAction;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Actions\TestBookings\CreateTestBookingAction;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Book A Test')
                ->action(function (array $data): void {
                    $dueDate = Carbon::parse($data['due_date']);
                $testBooking = (new CreateTestBookingAction)
                    ->forPatient($this->record)
                    ->atTestCenter($data['test_center_id'])
                    ->run($data['test_type_id'], LocationTypeEnum::CENTER, $dueDate);
                if ($data['place_order']) {
                    $order = (new GenerateOrderFromTestBookingAction)->run($testBooking);
                    if (isset($data['discount_id'])) {
                        (new LinkDiscountableAction())->run($data['discount_id'], $order);
                    }
                }
            })
                ->form([
                    Fieldset::make('General Info')->schema([
                        TextInput::make('reference')
                            ->maxLength(255)
                            ->helperText('Leave this blank and the system will generate one for you'),
                        Select::make('test_type_id')->label('Test Type')
                            ->options(TestType::all()->toSelectArray())->searchable(),
                    ])->columns(1),
                    Fieldset::make('Schedule and Location')->schema([
                        DateTimePicker::make('due_date')
                            ->label('Scheduled For')
                            ->required(),
                        TextInput::make('duration_minutes')
                            ->required(),
                        Select::make('test_center_id')->label('Test Center')
                            ->options(TestCenter::all()->toSelectArray())->searchable()->required(),
                    ])->columns(3),
                    Fieldset::make('Order')->schema([
                        Toggle::make('place_order')->label('Place an order Immediately?')
                            ->required(),
                        Select::make('discount_id')->label('Select a discount to apply')
                            ->options(Discount::all()->toSelectArray())->searchable(),
                    ]),
                ]),
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
                ]),
        ];
    }
}
