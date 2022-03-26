<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContactUs extends Component
{
    use LivewireAlert;


    protected $rules = [

    ];

    public function render()
    {
        return view('livewire.forms.contact-us');
    }

    public function submit()
    {
//        $this->validate();
        $this->flash('success', 'Your request has been sent!', [], '/');
    }
}
