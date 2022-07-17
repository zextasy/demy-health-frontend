<?php

namespace App\Http\Livewire\Forms\Filament;

use App\Models\Order;
use Livewire\Component;
use App\Models\TestBooking;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;

class OrderDisplay extends Component implements HasForms
{
    use InteractsWithForms;

    public Order $order;

    public function mount(): void
    {
        $this->form->fill([
            'reference' => $this->order->reference,
            'customer_email' => $this->order->customer_email,
            'total_amount' => $this->order->total_amount,
            'payment_method' => $this->order->payment_method->name,
            'status' => $this->order->status,
        ]);
    }

    protected function getFormSchema(): array
    {
        ray($this->order);
        return [
            Fieldset::make('Details')->schema([
                TextInput::make('reference')
                    ->maxLength(255),
                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('total_amount')
                    ->disabled()
                    ->numeric(),
                TextInput::make('payment_method')
                    ->disabled(),
                TextInput::make('status')
                    ->disabled(),
            ])->columns(2),

        ];
    }

    public function render()
    {
        return view('livewire.forms.filament.order-display');
    }
}
