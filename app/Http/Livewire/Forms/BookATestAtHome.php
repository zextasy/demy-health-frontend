<?php

namespace App\Http\Livewire\Forms;

use App\Models\State;
use Livewire\Component;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use App\Models\TestCategory;
use App\Models\LocalGovernmentArea;

class BookATestAtHome extends Component
{
    public $testCenters;
    public $states;
    public $localGovernmentAreas;
    public $testCategories;
    public $testTypes;

    public $selectedTestCategory = NULL;
    public $selectedState = NULL;
    public $testCenter = NULL;
    public $testType = NULL;
    public $localGovernmentArea = NULL;
    public $customerEmail = NULL;
    public $location = NULL;
    public $address = NULL;

    protected $rules = [
        'customerEmail' => 'required|email',
        'testCenter' => 'required_if:location,center',
        'selectedState' => 'required_if:location,home',
        'address' => 'required_if:location,home',
        'selectedTestCategory' => 'required',
        'testType' => 'required',
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
        return view('livewire.forms.book-a-test-at-home');
    }

    public function submit()
    {
        $this->validate();
        flash()->overlay('Your test has been booked.','success')->livewire($this);
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
