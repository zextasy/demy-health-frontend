<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestCenter;
use Illuminate\Support\Carbon;
use App\Events\TestBookedEvent;
use Illuminate\Support\Facades\DB;
use App\Helpers\FlashMessageHelper;
use App\Enums\TestBooking\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Actions\Addresses\CreateAddressAction;
use App\Http\Requests\StoreTestBookingRequest;
use App\Actions\TestBookings\CreateTestBookingAction;

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
        DB::transaction(function (){
            $locationTypeEnum = LocationTypeEnum::from($this->locationType);
            $carbonDueDate = Carbon::make($this->dueDate);
            $testBooking = (new CreateTestBookingAction)
                ->atTestCenter($this->selectedTestCenter)
                ->run($this->selectedTestType, $this->customerEmail, $locationTypeEnum, $carbonDueDate);

            $address = match ($locationTypeEnum){
                LocationTypeEnum::HOME => (new CreateAddressAction)->run($this->addressLine1, $this->addressLine2, $this->city, $this->selectedState, $this->selectedLocalGovernmentArea),
                LocationTypeEnum::CENTER => TestCenter::find($this->selectedTestCenter)->latest_address,
            };

            $address->TestBookings()->save($testBooking);

            TestBookedEvent::dispatch($testBooking);

            $this->success = isset($testBooking,$address);
        });


        if ($this->success){

            $this->flash('success', FlashMessageHelper::TEST_BOOKING_SUCCESSFUL, [], '/');

        } else{
            $this->alert('error',FlashMessageHelper::GENERAL_ERROR);
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
