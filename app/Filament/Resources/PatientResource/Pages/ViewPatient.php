<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Models\TestType;
use App\Models\TestCenter;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use App\Filament\Pages\PlaceOrder;
use App\Jobs\ChangePatientEmailJob;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions\EditAction;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use Filament\Pages\Actions\ActionGroup;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\PatientResource;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Actions\Payments\CreatePaymentAction;
use App\Actions\Discounts\LinkDiscounterAction;
use App\Filament\Resources\TestBookingResource;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Actions\TestBookings\CreateTestBookingAction;
use App\Enums\Communication\CommunicationChannelEnum;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;
use App\Filament\Actions\Pages\Payments\CapturePaymentAction;
use App\Filament\Actions\Pages\Discounts\AttachDiscountAction;
use App\Filament\Actions\Pages\Patients\ChangePatientEmailAction;
use App\Filament\Actions\Pages\Patients\RegisterPatientVisitAction;
use App\Filament\Actions\Pages\TestBookings\BookATestForPatientAction;
use App\Filament\Actions\Pages\Communications\SendCommunicationAction;

class ViewPatient extends ViewRecord
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                EditAction::make()->label('Edit patient data'),
                ChangePatientEmailAction::make('change email')->subject($this->record),
            ])->icon('heroicon-s-pencil'),
            ActionGroup::make([
                CapturePaymentAction::make()->payer($this->record),
                AttachDiscountAction::make()->subject($this->record)
                    ->visible($this->record->canApplyDiscount()),
            ])->icon('heroicon-m-banknotes')->label('Finance'),
            ActionGroup::make([
                SendCommunicationAction::make()->communicable($this->record)
                    ->visible($this->record->hasValidRoute(CommunicationChannelEnum::EMAIL())),
            ])->icon('heroicon-s-at-symbol')->label('Communication'),
            ActionGroup::make([
                Action::make('Place an Order')
                    ->url(PlaceOrder::getUrl([
                        'customerEmail' => $this->record->email,
                        'customerPhoneNumber' => $this->record->phone_number,
                        'patientId' => $this->record->id
                    ])),
                BookATestForPatientAction::make('Book A Test')->subject($this->record),
            ])->icon('heroicon-s-bookmark'),
            RegisterPatientVisitAction::make()->subject($this->record),
        ];
    }
}
