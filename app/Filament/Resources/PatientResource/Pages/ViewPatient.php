<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Models\TestType;
use App\Models\TestCenter;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use App\Jobs\ChangePatientEmailJob;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\EditAction;
use Filament\Forms\Components\Fieldset;
use Filament\Pages\Actions\ActionGroup;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\PatientResource;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Actions\Discounts\LinkDiscounterAction;
use App\Filament\Resources\TestBookingResource;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Actions\TestBookings\CreateTestBookingAction;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    protected function getActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make()->label('Edit patient data'),
                Action::make('change email')
                    ->action(function (array $data): void {
                        ChangePatientEmailJob::dispatch($this->record->id, $data['email']);
                        $this->notify('success', 'The email will be changed!');
                        $this->redirect(PatientResource::getUrl('view', ['record' => $this->record->id]));
                    })
                    ->form([
                        TextInput::make('email')
                            ->label('email')
                            ->required(),
                    ])
                    ->groupedIcon('heroicon-s-at-symbol')
                    ->modalSubheading('This will change the email for the patient and all associated test bookings, test results, orders and invoices.'),
            ])->icon('heroicon-s-pencil'),
            Action::make('Book A Test')
                ->action(function (array $data): void {
                    $dueDate = Carbon::parse($data['due_date']);
                $testBooking = (new CreateTestBookingAction)
                    ->forPatient($this->record)
                    ->atTestCenter($data['test_center_id'])
                    ->run($data['test_type_id'], LocationTypeEnum::CENTER, $dueDate);
                    $this->notify('success', 'Success!');
                    $this->redirect(TestBookingResource::getUrl('view', ['record' => $testBooking->id]));
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
                            ->helperText('The discount will only be applied if you place an order immediately')
                            ->options(Discount::all()->toSelectArray())->searchable(),
                    ]),
                ]),
            Action::make('Attach Discount')
                ->action(function (array $data): void {
                    (new LinkDiscounterAction)
                        ->run($data['discount_id'], $this->record);
                    $this->notify('success', 'Success!');
                    $this->redirect(PatientResource::getUrl('view', ['record' => $this->record->id]));
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
