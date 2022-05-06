<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\ContactUsFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContactUs extends Component
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
        return view('livewire.forms.contact-us');
    }

    public function submit()
    {
        $this->validate();
        ContactUsFormSubmittedEvent::dispatch($this->customerEmail, $this->customerName, $this->message);
        $this->flash('success', 'Your request has been sent!', [], '/');
    }
}
