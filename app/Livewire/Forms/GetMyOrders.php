<?php

namespace App\Livewire\Forms;

use App\Traits\Livewire\ManipulatesCustomerSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetMyOrders extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public function render()
    {
        return view('livewire.forms.get-my-orders');
    }
}
