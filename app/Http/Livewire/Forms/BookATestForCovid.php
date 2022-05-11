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
use Illuminate\Support\Carbon;
use App\Events\TestBookedEvent;
use Illuminate\Support\Facades\DB;
use App\Models\LocalGovernmentArea;
use App\Enums\TestBooking\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Actions\Addresses\CreateAddressAction;
use App\Http\Requests\StoreTestBookingRequest;
use App\Actions\TestBookings\CreateTestBookingAction;

class BookATestForCovid extends Component
{
    use LivewireAlert;

    private bool $success = false;
    public $testCenters;
    public $states;
    public $localGovernmentAreas;
    public $testCategories;
    public $testTypes;

    public $selectedTestCategory = null;
    public $selectedState;
    public $selectedTestCenter = null;
    public $selectedTestType = null;
    public $selectedLocalGovernmentArea = null;
    public $customerEmail = null;
    public $locationType = null;
    public $addressLine1 = null;
    public $addressLine2 = null;
    public $city = null;
    public $dueDate;
    public $startTime;

    protected $listeners = [
        'selectedTestCenterUpdated' => 'setSelectedTestCenter',
        'selectedStateUpdated' => 'setSelectedState',
        'selectedLocalGovernmentAreaUpdated' => 'setSelectedLocalGovernmentArea',
        'selectedTestTypeUpdated' => 'setSelectedTestType',
    ];

    protected function rules () : array
    {
        return (new StoreTestBookingRequest())->rules();
    }

    protected function getMessages()
    {
        return (new StoreTestBookingRequest())->messages();
    }

    public function mount()
    {
        $this->testCategories = TestCategory::query()->where('name','like','%COVID%')->get();
        $this->testTypes = collect();
        $this->customerEmail = optional(auth()->user())->email;
    }

    public function render()
    {
        return view('livewire.forms.book-a-test-for-covid');
    }

    public function submit()
    {

        $this->validate();
        DB::transaction(function (){
            $locationTypeEnum = LocationTypeEnum::from($this->locationType);
            $carbonDueDate = Carbon::make($this->dueDate);
            $testBooking = (new CreateTestBookingAction)
                ->atTestCenter($this->selectedTestCenter)
                ->run($this->selectedTestType, $this->customerEmail, $locationTypeEnum, $carbonDueDate);
            $this->success = isset($testBooking);

            if ($locationTypeEnum == LocationTypeEnum::Home){
                $newAddress = (new CreateAddressAction)->run($this->addressLine1, $this->addressLine2, $this->city, $this->selectedState, $this->selectedLocalGovernmentArea);
                $newAddress->TestBookings()->save($testBooking);
                $this->success = isset($newAddress);
            }

            if ($locationTypeEnum == LocationTypeEnum::Center){
                $testCenter = TestCenter::find($this->selectedTestCenter);
                $centerAddress =$testCenter->latest_address;
                $centerAddress->TestBookings()->save($testBooking);
            }
            TestBookedEvent::dispatch($testBooking);
        });

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
