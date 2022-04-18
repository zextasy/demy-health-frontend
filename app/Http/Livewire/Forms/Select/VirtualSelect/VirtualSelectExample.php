<?php

namespace App\Http\Livewire\Forms\Select\VirtualSelect;

use App\Models\State;
use Livewire\Component;
use App\Models\TestType;
use App\Models\TestCenter;

class VirtualSelectExample extends Component
{
    public $selectedUsers;

    public function mount()
    {
        $this->users = TestType::all();
    }
    public function render()
    {
        return view('livewire.forms.select.virtual-select.virtual-select-example');
    }
}
