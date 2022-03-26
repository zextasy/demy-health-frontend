<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetInTouch extends Component
{
    use LivewireAlert;

    protected $rules = [

    ];

    public function render()
    {
        return view('livewire.forms.get-in-touch');
    }

    public function submit()
    {
//        $this->validate();
        $this->flash('success', 'Thank you for reaching out!', [], '/');
    }
}
