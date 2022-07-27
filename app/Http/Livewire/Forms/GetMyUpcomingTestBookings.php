<?php

namespace App\Http\Livewire\Forms;

use App\Models\Patient;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetMyUpcomingTestBookings extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $customerIdentifier = null;

    public $testBookingReference = null;

    protected $rules = [
        'customerIdentifier' => 'required|string',
        'testBookingReference' => 'nullable|exists:test_bookings,reference',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->customerIdentifier = $this->getSessionCustomerIdentifier();
    }

    public function render()
    {
        return view('livewire.forms.get-my-upcoming-test-bookings');
    }

    public function getTestBookings()
    {
        $this->validate();
        $this->setSessionCustomerIdentifier($this->customerIdentifier);
        $patient = Patient::withCustomerDetails($this->customerIdentifier)->first();
        if (empty($patient)) {
            $this->alert('error', 'No valid patient data found');

            return;
        }
        $this->redirect(route('frontend.my-test-bookings.list', $this->customerIdentifier));
    }
}
