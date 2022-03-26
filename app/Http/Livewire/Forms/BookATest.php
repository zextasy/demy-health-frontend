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
use App\Models\LocalGovernmentArea;
use App\Enums\TestBooking\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BookATest extends Component
{
    use LivewireAlert;

    private bool $success = false;
    public $testCenters;
    public $states;
    public $localGovernmentAreas;
    public $testCategories;
    public $testTypes;

    public $selectedTestCategory = null;
    public $selectedState = null;
    public $testCenter = null;
    public $testType = null;
    public $localGovernmentArea = null;
    public $customerEmail = null;
    public $locationType = null;
    public $address = null;
    public $city = null;
    public $dueDate;
    public $startTime;

    protected $rules = [
        'locationType' => 'required',
        'customerEmail' => 'required|email',
        'testCenter' => "required_if:locationType,1",//LocationTypeEnum::Center
        'selectedState' => 'required_if:locationType,2',//LocationTypeEnum::Home
        'address' => 'required_if:location_type,2',//LocationTypeEnum::Home
        'selectedTestCategory' => 'required',
        'testType' => 'required',
        'dueDate' => 'required',
        'startTime' => 'required',

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->testCenters = TestCenter::all();
        $this->states = State::where('is_ready_for_sample_collection', true)->get();
        $this->localGovernmentAreas = collect();
        $this->testCategories = TestCategory::all();
        $this->testTypes = collect();
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
            'test_type_id' => $this->testType,
            'user_id' => optional($possibleUser)->id,
            'customer_email' => $this->customerEmail,
            'location_type' => $locationTypeEnum,
            'test_center_id' => $this->testCenter,
            'due_date' => $this->dueDate,
            'start_time' => $this->startTime,
        ]);
        $this->success = isset($testBooking);

        if ($locationTypeEnum == LocationTypeEnum::Home){
            $address = Address::create([
                'line_1' => $this->address,
                'city' => $this->city,
                'state_id' => $this->selectedState,
                'local_government_area_id' => $this->localGovernmentArea,
                'addressable_type' => get_class($testBooking),
                'addressable_id' => $testBooking->id,
            ]);

            $this->success = isset($address);
        }

        if ($this->success){
            $this->flash('success', 'Your test has been booked!', [], '/');

        } else{
            $this->alert('error','There was a problem');
        }
    }

    public function updatedSelectedTestCategory($testCategoryId)
    {
        if (!is_null($testCategoryId)) {
            $this->testTypes = TestType::where('test_category_id', $testCategoryId)->get();
        }
    }

    public function updatedSelectedState($stateId)
    {
        if (!is_null($stateId)) {
            $this->localGovernmentAreas = LocalGovernmentArea::where('state_id', $stateId)->get();
        }
    }
}
