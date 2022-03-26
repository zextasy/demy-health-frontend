<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestBooking;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetTestResults extends Component
{
    use LivewireAlert;

    public $customerEmail = null;
    public $testBookingReference;

    protected $rules = [
        'customerEmail' => 'required|email',
        'testBookingReference' => 'required|exists:test_bookings,reference', //test_bookings,reference
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.forms.get-test-results');
    }

    public function getTestResults()
    {
        $this->validate();
        $testBooking = TestBooking::query()->where('reference',$this->testBookingReference)->first();

        if ($testBooking->customer_email != $this->customerEmail){
            $this->alert('error','The email does not match booking reference');
            return;
        }

        if (is_null($testBooking->result)){
            $this->alert('warning','Your results are still being processed');
            return;
        }

        $this->flash('success', 'Your results will be sent via email!', [], '/');
    }
}
