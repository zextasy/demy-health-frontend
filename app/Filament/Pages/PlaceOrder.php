<?php

namespace App\Filament\Pages;

use App\Actions\Orders\CreateOrderAction;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\OrderResource;
use App\Models\Product;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class PlaceOrder extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-view-grid-add';

    protected static string $view = 'filament.pages.place-order';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $title = 'Place an Order';

    protected static ?int $navigationSort = 2;

    public $reference;

    public $customerEmail;

    public $paymentMethod;

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make('Intro')
                    ->schema([
                        TextInput::make('reference')
                            ->maxLength(255)
                            ->helperText('Reference number for the order. Leave this blank and the system will generate one for you'),
                        TextInput::make('customerEmail')
                            ->email()
                            ->maxLength(255)
                            ->required()
                            ->helperText('Customer email address. This is required for the system to know who to send the order to'),
                    ]),
                Step::make('Order Data')
                    ->schema([
                        Repeater::make('products')
                            ->schema([
                                Select::make('productId')
                                    ->label('Product')
                                    ->options(Product::all()->toSelectArray())
                                    ->searchable()
                                    ->required(),
                                TextInput::make('quantity')->integer()->required(),
                            ])
                            ->columns(3),
                    ]),
                Step::make('Confirmation')
                    ->schema([
                        TextInput::make('summary')
                            ->disabled()
                            ->afterStateHydrated(function (TextInput $component, $state) {
                                $component->state($this->getOrderSummary());
                            })
                            ->helperText('Summary of the order. Please confirm that this is correct before submitting'),
                    ]),
            ])
                ->submitAction(view('filament.forms.components.wizard-submit-button')),
        ];
    }

    public function submitWizard(): void
    {
        try {
            $productCollection = new Collection();
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
                $productCollection->push($orderableItemCollection);
            }
            $order = (new CreateOrderAction)->run($productCollection, $this->customerEmail);

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
