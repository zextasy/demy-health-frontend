<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\GetInTouchFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;
use App\Actions\CRM\CustomerEnquiries\CreateCustomerEnquiryAction;

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
        $customerEnquiry = (new CreateCustomerEnquiryAction)->forType(EnquiryTypeEnum::GENERAL)->run($this->customerEmail, $this->customerName, $this->message);
        GetInTouchFormSubmittedEvent::dispatch($customerEnquiry->id);
        $this->flash('success', 'Thank you for reaching out!', [], '/');
    }
}
