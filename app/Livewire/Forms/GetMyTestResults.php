<?php

namespace App\Livewire\Forms;

use App\Models\TestBooking;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class GetMyTestResults extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $customerIdentifier = null;

    public $testBookingReference = null;

    protected $rules = [
        'customerIdentifier' => 'required|email',
        'testBookingReference' => 'required|exists:test_bookings,reference',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->customerIdentifier = $this->getSessionCustomerIdentifier();
    }

    public function getTestResults()
    {
        $this->validate();
        $this->setSessionCustomerIdentifier($this->customerIdentifier);
        $testBooking = TestBooking::query()->where('reference', $this->testBookingReference)->first();

        if ($testBooking->customer_email != $this->customerIdentifier) {
            $this->testBookingReference = null;
            $this->alert('error', 'The email does not match booking reference');

            return;
        }

        $testResult = $testBooking->testResults()->latest()->firstOrFail(); //TODO: change to query approved_at when process id finished

        $this->redirect(route('frontend.test-results.show', $testResult->id));
    }

    public function render()
    {
        return view('livewire.forms.get-my-test-results');
    }
}
