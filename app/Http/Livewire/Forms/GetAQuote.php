<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetAQuote extends Component
{
    use LivewireAlert;

    protected $rules = [

    ];

    public function render()
    {
        return view('livewire.forms.get-a-quote');
    }

    public function submit()
    {
//        $this->validate();
        $this->flash('success', 'We will get in touch with you for a quote!', [], '/');
    }
}
