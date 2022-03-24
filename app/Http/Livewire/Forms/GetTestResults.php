<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GetTestResults extends Component
{
    use LivewireAlert;

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
        $this->flash('success', 'Your results will be sent via email!', [], '/');
    }
}
