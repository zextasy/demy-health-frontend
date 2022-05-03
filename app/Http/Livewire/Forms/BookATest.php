<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use App\Models\State;
use Livewire\Component;
use App\Models\Address;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use App\Models\TestCategory;
use App\Events\TestBookedEvent;
use App\Models\LocalGovernmentArea;
use App\Enums\TestBooking\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BookATest extends Component
{
    use LivewireAlert;

    private bool $success = false;

    public $selectedTestCenter;
    public $selectedState;
    public $selectedLocalGovernmentArea;
    public $selectedTestType;


    public $customerEmail = null;
    public $locationType = null;
    public $addressLine1 = null;
    public $city = null;
    public $dueDate;
    public $startTime;

    protected $listeners = [
        'selectedTestCenterUpdated' => 'setSelectedTestCenter',
        'selectedStateUpdated' => 'setSelectedState',
        'selectedLocalGovernmentAreaUpdated' => 'setSelectedLocalGovernmentArea',
        'selectedTestTypeUpdated' => 'setSelectedTestType',
    ];

    protected $rules = [
        'locationType' => 'required',
        'customerEmail' => 'required|email',
//        'test_center_id' => "required_if:locationType,1",//LocationTypeEnum::Center
//        'state_id' => 'required_if:locationType,2',//LocationTypeEnum::Home
        'addressLine1' => 'required_if:location_type,2',//LocationTypeEnum::Home
//        'test_type_id' => 'required',
        'dueDate' => 'required',
        'startTime' => 'required',

    ];

    public function mount()
    {
        $this->customerEmail = optional(auth()->user())->email;
    }

    public function stateToParent($value)
    {
        $this->selectedState = $value;
    }

    public function render()
    {
        return view('livewire.forms.book-a-test');
    }

    public function submit()
    {
        $this->validate();
        $possibleUser = User::query()->where('email',$this->customerEmail)->first();
        $locationTypeEnum = LocationTypeEnum::from($this->locationType);
        $testBooking = TestBooking::create([
            'test_type_id' => $this->selectedTestType,
            'user_id' => optional($possibleUser)->id,
            'customer_email' => $this->customerEmail,
            'location_type' => $locationTypeEnum,
            'test_center_id' => $this->selectedTestCenter,
            'due_date' => $this->dueDate,
            'start_time' => $this->startTime,
        ]);
        $this->success = isset($testBooking);

        if ($locationTypeEnum == LocationTypeEnum::Home){
            $newAddress = Address::create([
                'line_1' => $this->addressLine1,
                'city' => $this->city,
                'state_id' => $this->selectedState,
                'local_government_area_id' => $this->selectedLocalGovernmentArea,
                'addressable_type' => get_class($testBooking),
                'addressable_id' => $testBooking->id,
            ]);

            $this->success = isset($newAddress);
        }

        if ($this->success){
            TestBookedEvent::dispatch($testBooking);
            $this->flash('success', 'Your test has been booked!', [], '/');

        } else{
            $this->alert('error','There was a problem');
        }
    }

    public function setSelectedTestCenter($object)
    {
        $this->selectedTestCenter = $object['value'];
    }

    public function setSelectedState($object)
    {
        $this->selectedState = $object['value'];
    }

    public function setSelectedLocalGovernmentArea($object)
    {
        $this->selectedLocalGovernmentArea = $object['value'];
    }

    public function setSelectedTestType($object)
    {
        $this->selectedTestType = $object['value'];
    }
}
