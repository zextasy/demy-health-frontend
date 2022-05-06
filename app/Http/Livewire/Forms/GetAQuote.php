<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Events\GetAQuoteFormSubmittedEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Actions\Addresses\CreateAddressAction;

class GetAQuote extends Component
{
    use LivewireAlert;

    public $customerName = null;
    public $customerEmail = null;
    public $selectedState;
    public $selectedLocalGovernmentArea;
    public $city = null;
    public $addressLine1 = null;
    public $addressLine2 = null;
    public $message = null;

    protected $rules = [
        'customerEmail' => 'required|email',
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
        //TODO create Lab setup Service,link address
        GetAQuoteFormSubmittedEvent::dispatch($this->customerEmail, $this->customerName, $this->message, $newAddress->id);
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
