<?php

namespace App\Livewire\Forms;

use App\Actions\CRM\CustomerEnquiries\CreateCustomerEnquiryAction;
use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use App\Events\ContactUsFormSubmittedEvent;
use App\Helpers\FlashMessageHelper;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ContactUs extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $customerName = null;

    public $customerEmail = null;

    public $message = null;

    protected $rules = [
        'customerEmail' => 'required|email',
    ];

    public function mount()
    {
        $this->customerEmail = $this->getSessionCustomerEmail();
    }

    public function render()
    {
        return view('livewire.forms.contact-us');
    }

    public function submit()
    {
        $this->validate();
        $customerEnquiry = (new CreateCustomerEnquiryAction)->forType(EnquiryTypeEnum::GENERAL)->run($this->customerEmail, $this->customerName, $this->message);
        $this->setSessionCustomerEmail($this->customerEmail);
        ContactUsFormSubmittedEvent::dispatch($customerEnquiry->id);
        $this->flash('success', FlashMessageHelper::GENERAL_ENQUIRY_REQUEST_SUCCESSFUL, [], '/');
    }
}
