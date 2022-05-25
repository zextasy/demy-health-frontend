<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\ContactUsFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;
use App\Actions\CRM\CustomerEnquiries\CreateCustomerEnquiryAction;

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
        $customerEnquiry = (new CreateCustomerEnquiryAction)->forType(EnquiryTypeEnum::GENERAL)->run($this->customerEmail, $this->customerName, $this->message);
        ContactUsFormSubmittedEvent::dispatch($customerEnquiry->id);
        $this->flash('success', 'Your request has been sent!', [], '/');
    }
}
