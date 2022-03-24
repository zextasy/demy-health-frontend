<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

class GetTestResults extends Component
{
    public $testBookingReference;

    protected $rules = [
        'testBookingReference' => 'required|exists:test_types,test_id', //test_bookings,reference
    ];

    public function render()
    {
        return view('livewire.forms.get-test-results');
    }

    public function getTestResults()
    {
        $this->validate();
        //        ray($this);
        //        TestBooking::create($validatedData);
        flash()->overlay('Your test has been booked.','success');
        return redirect()->to('/index.html');
    }
}
