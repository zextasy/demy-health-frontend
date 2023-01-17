<?php

namespace App\Filament\Actions\Pages\TestBookings;

use App\Models\Patient;
use App\Models\TestType;
use App\Models\TestCenter;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Actions\Pages\BasePageAction;
use App\Filament\Resources\TestBookingResource;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Actions\TestBookings\CreateTestBookingAction;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;

class BookATestForPatientAction extends BasePageAction
{

    private ?Patient $subject = null;

    public static function getDefaultName(): ?string
    {
        return 'Book A Test';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-play')
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
            ])->action(function (array $data): void {
                $this->runAction($data) ? $this->success() : $this->failure();
            });
    }

    public function subject(Patient $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            $dueDate = Carbon::parse($data['due_date']);
            $testBooking = (new CreateTestBookingAction)
                ->forPatient($this->subject)
                ->atTestCenter($data['test_center_id'])
                ->run($data['test_type_id'], LocationTypeEnum::CENTER, $dueDate);
            if ($data['place_order']) {
                $order = (new GenerateOrderFromTestBookingAction)->run($testBooking);
                if (isset($data['discount_id'])) {
                    (new LinkDiscountableAction())->run($data['discount_id'], $order);
                }
            }
            $this->successRedirectUrl(TestBookingResource::getUrl('view', ['record' => $testBooking->id]));
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

}
