<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\GetAQuoteFormSubmittedEvent;
use App\Events\ContactUsFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Actions\Addresses\CreateAddressAction;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;
use App\Actions\CRM\CustomerEnquiries\CreateCustomerEnquiryAction;

class GetAQuote extends Component
{
    use LivewireAlert;

    public $customerName = null;
    public $customerEmail = null;
    public $selectedState;
    public $selectedLocalGovernmentArea;
    public $city = "-";
    public $addressLine1 = "-";
    public $addressLine2 = "-";
    public $message = "-";

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
        $this->customerEmail = optional(auth()->user())->email;
    }

    public function render()
    {
        return view('livewire.forms.get-a-quote');
    }

    public function submit()
    {
        $this->validate();
        $newAddress = (new CreateAddressAction)->run($this->addressLine1, $this->addressLine2, $this->city, $this->selectedState, $this->selectedLocalGovernmentArea);
        $customerEnquiry = (new CreateCustomerEnquiryAction)->forType(EnquiryTypeEnum::QUOTE)->run($this->customerEmail, $this->customerName, $this->message);
        $newAddress->customerEnquiries()->save($customerEnquiry);
        ContactUsFormSubmittedEvent::dispatch($customerEnquiry->id);
        $this->flash('success', 'We will get in touch with you for a quote!', [], '/');
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
