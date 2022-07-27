<?php

namespace App\Http\Livewire\Forms;

use App\Actions\Addresses\CreateAddressAction;
use App\Actions\CRM\CustomerEnquiries\CreateCustomerEnquiryAction;
use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use App\Events\ContactUsFormSubmittedEvent;
use App\Helpers\FlashMessageHelper;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetAQuote extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $customerName = null;

    public $customerEmail = null;

    public $selectedState;

    public $selectedLocalGovernmentArea;

    public $city = '-';

    public $addressLine1 = '-';

    public $addressLine2 = '-';

    public $message = null;

    protected $rules = [
        'customerEmail' => 'required|email',
        'selectedState' => 'required',
        'selectedLocalGovernmentArea' => 'required',
    ];

    protected $listeners = [
        'selectedStateUpdated' => 'setSelectedState',
        'selectedLocalGovernmentAreaUpdated' => 'setSelectedLocalGovernmentArea',
    ];

    public function mount()
    {
        $this->customerEmail = $this->getSessionCustomerEmail();
    }

    public function render()
    {
        return view('livewire.forms.get-a-quote');
    }

    public function submit()
    {
        $this->validate();
        $newAddress = (new CreateAddressAction)->run($this->addressLine1, $this->addressLine2, $this->city, $this->selectedLocalGovernmentArea, $this->selectedState);
        $customerEnquiry = (new CreateCustomerEnquiryAction)->forType(EnquiryTypeEnum::QUOTE)->run($this->customerEmail, $this->customerName, $this->message);
        $newAddress->customerEnquiries()->save($customerEnquiry);
        $this->setSessionCustomerEmail($this->customerEmail);
        ContactUsFormSubmittedEvent::dispatch($customerEnquiry->id);
        $this->flash('success', FlashMessageHelper::QUOTE_ENQUIRY_REQUEST_SUCCESSFUL, [], '/');
    }

    public function setSelectedState($object)
    {
        $this->selectedState = $object['value'];
    }

    public function setSelectedLocalGovernmentArea($object)
    {
        $this->selectedLocalGovernmentArea = $object['value'];
    }
}
