<?php

namespace App\Filament\Pages;


use App\Models\Product;
use App\Models\Patient;
use Filament\Pages\Page;
use App\Models\TestType;
use App\Enums\GenderEnum;
use Illuminate\Support\Carbon;
use App\Models\Finance\Discount;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use App\Actions\Orders\CreateOrderAction;
use App\Filament\Resources\OrderResource;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Placeholder;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Actions\Patients\CreatePatientAction;
use App\Actions\Discounts\LinkDiscountableAction;
use App\Actions\TestBookings\CreateTestBookingAction;
use App\Actions\Invoices\GenerateInvoiceForOrderAction;

class PlaceOrder extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-view-grid-add';

    protected static string $view = 'filament.pages.place-order';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $title = 'Place an Order';

    protected static ?int $navigationSort = 2;

    public ?string $reference = null;

    public ?string $customerEmail = null;

    public ?string $customerPhoneNumber = null;

    private bool $hasCustomer = false;


    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
        $customer = Patient::find(request()->get('patientId'));
        $this->form->fill([
            'customerEmail' => request()->get('customerEmail'),
            'customerPhoneNumber' => request()->get('customerPhoneNumber'),
            'customerFirstName' => $customer?->first_name,
            'customerLastName' => $customer?->last_name,
            'customerGender' => $customer?->gender->value,
        ]);

        if ($customer) {
            $this->hasCustomer = true;
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make('Order Data')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('reference')
                                    ->maxLength(255)
                                    ->helperText(HelpTextMessageHelper::ORDER_REFERENCE_TEXT),
                            ]),
                        Repeater::make('products')
                            ->schema([
                                Select::make('productId')
                                    ->label('Product')
                                    ->options(Product::all()->toSelectArray())
                                    ->searchable()
                                    ->required(),
                                TextInput::make('quantity')->integer()->required(),
                            ])
                            ->columns(2),
                        Repeater::make('tests')
                            ->schema([
                                Select::make('testTypeId')
                                    ->label('Test')
                                    ->options(TestType::all()->toSelectArray())
                                    ->searchable()
                                    ->required(),
                                TextInput::make('quantity')->integer()->required()
                                    ->default(1)->maxLength(10),
                                DateTimePicker::make('dueDate')->required(),
                            ])
                            ->columns(3),
                    ]),
                Step::make('Customer Details')
                    ->schema([
                        Card::make()->schema([
                            TextInput::make('customerEmail')
                                ->email()
                                ->maxLength(255)
                                ->required()
                                ->disabled($this->hasCustomer)
                                ->helperText(HelpTextMessageHelper::ORDER_CUSTOMER_EMAIL_TEXT),
                            TextInput::make('customerPhoneNumber')
                                ->disabled($this->hasCustomer)
                                ->maxLength(25),
                            TextInput::make('customerFirstName')->required()->disabled($this->hasCustomer),
                            TextInput::make('customerLastName')->required()->disabled($this->hasCustomer),
                            Select::make('customerGender')->options(GenderEnum::optionsAsSelectArray())
                                ->required()->disabled($this->hasCustomer),
                        ])->columns(2),
                    ]),
                Step::make('Discount')
                    ->schema([
                        Select::make('discountId')
                            ->label('Discount')
                            ->options(Discount::all()->toSelectArray())
                            ->searchable(),
                    ]),
                Step::make('Confirmation')
                    ->schema([
                        Checkbox::make('shouldGenerateInvoice')->label('Generate Invoice?')
                            ->helperText('Check this box to generate an invoice for this Order automatically.'),
                        Placeholder::make('summary')
                            //                            ->content($this->getOrderSummary())
                            ->helperText('Summary of the order. Please confirm that this is correct before submitting'),
                    ]),
            ])
                ->submitAction(view('filament.forms.components.wizard-submit-button')),
        ];
    }

    public function submitWizard(): void
    {
        try {
            $orderItems = new Collection();
            if (!empty($this->products)) {
                foreach ($this->products as $productArray) {
                    $productModel = Product::find($productArray['productId']);
                    $orderableItemCollection = collect(
                        [
                            'model' => $productModel,
                            'name' => $productModel->name,
                            'price' => $productModel->price,
                            'quantity' => $productArray['quantity'],
                        ]
                    );
                    $orderItems->push($orderableItemCollection);
                }
            }

            if (!empty($this->tests)) {
                foreach ($this->tests as $testArray) {
                    $testType = TestType::find($testArray['testTypeId']);
                    $dueDate = Carbon::parse($testArray['dueDate']);
                    $patient = Patient::where('email', $this->customerEmail)->first();
                    if (empty($patient)) {
                        $genderEnum = GenderEnum::from(intval($this->customerGender));
                        $patient = (new CreatePatientAction)
                            ->withContactDetails($this->customerEmail, $this->customerPhoneNumber)
                            ->run($this->customerFirstName, $this->customerLastName, $genderEnum);
                    }
                    $testBooking = (new CreateTestBookingAction())->forPatient($patient)
                        ->run($testType, LocationTypeEnum::CENTER, $dueDate);
                    $orderableItemCollection = collect(
                        [
                            'model' => $testBooking,
                            'name' => $testBooking->name,
                            'price' => $testBooking->price,
                            'quantity' => $testArray['quantity'],
                        ]
                    );
                    $orderItems->push($orderableItemCollection);
                }
            }

            $order = (new CreateOrderAction)->run($orderItems, $this->customerEmail);

            if (isset($this->discountId)) {
                (new LinkDiscountableAction)->run($this->discountId, $order);
            }

            if ($this->shouldGenerateInvoice) {
                (new GenerateInvoiceForOrderAction)->run($order);
            }

            $this->notify('success', 'Order created!');
            $this->redirect(OrderResource::getUrl('view', ['record' => $order->id]));
        } catch (\Exception $e) {
            $this->notify('danger', 'Something went wrong'.$e->getMessage());
        }
    }

    private function getOrderSummary(): string
    {
        $summary = '';
        foreach ($this->products as $product) {
            $summary .= $product->productId.' x '.$product->quantity."\n";
        }

        return $summary;
    }
}
