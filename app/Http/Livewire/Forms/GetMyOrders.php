<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\Livewire\ManipulatesCustomerSession;

class GetMyOrders extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public function render()
    {
        return view('livewire.forms.get-my-orders');
    }
}
