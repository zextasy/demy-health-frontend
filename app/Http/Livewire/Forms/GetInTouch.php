<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\GetInTouchFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetInTouch extends Component
{
    use LivewireAlert;

    public $customerName = null;
    public $customerEmail = null;
    public $message = null;

    protected $rules = [
        'customerEmail' => 'required|email',
    ];

    public function render()
    {
        return view('livewire.forms.get-in-touch');
    }

    public function submit()
    {
        $this->validate();
        GetInTouchFormSubmittedEvent::dispatch($this->customerEmail, $this->customerName, $this->message);
        $this->flash('success', 'Thank you for reaching out!', [], '/');
    }
}
