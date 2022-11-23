<?php

namespace App\Http\Livewire\Forms\Select;

use BackedEnum;
use Livewire\Component;

class ArraySelect extends Component
{
    public BackedEnum $enum;

    public function mount(BackedEnum $enum)
    {
        $this->enum = $enum;
    }

    public function render()
    {
        return view('livewire.forms.select.array-select');
    }
}
