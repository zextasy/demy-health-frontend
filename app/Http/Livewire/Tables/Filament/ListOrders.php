<?php

namespace App\Http\Livewire\Tables\Filament;

use App\Models\Order;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListOrders extends Component implements HasTable
{
    use LivewireAlert, InteractsWithTable, ManipulatesCustomerSession;

    public $customerIdentifier = null;

    public $orderReference;

    public $clientId;

    protected $rules = [
        'customerIdentifier' => 'required|string',
        'orderReference' => 'nullable|exists:orders,reference',
    ];

    protected function getTableQuery(): Builder
    {
        return Order::query()->with(['user'])->where('customer_email', $this->customerIdentifier)->latest(); //
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Order status'),
            TextColumn::make('reference'),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->url(fn (Order $record): string => route('frontend.orders.show', $record->id)),
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->customerIdentifier = $this->getSessionCustomerIdentifier();
//                $this->table->shouldRender(false);
    }

    public function render()
    {
        return view('livewire.tables.filament.list-orders');
    }

    public function getTestResults()
    {
        $this->validate();
        $this->setSessionCustomerIdentifier($this->customerIdentifier);
    }
}
