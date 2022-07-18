<?php

namespace App\Http\Livewire\Forms\Select;

use Livewire\Component;

class EnumSelect extends Component
{
    public \BackedEnum $enum;
    public function render()
    {
        return view('livewire.forms.select.enum-select');
    }
}
