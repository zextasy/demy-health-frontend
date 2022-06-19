<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestType;
use App\Helpers\FlashMessageHelper;
use Illuminate\Contracts\View\View;
use App\Events\TestAddedToCartEvent;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Session;
use App\Enums\TestBookings\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Requests\StoreTestBookingRequest;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Foundation\Application;

class BookATest extends Component
{
    use LivewireAlert;

    public $selectedTestCenter;
    public $selectedStateForTestCenterBooking;
    public $selectedStateForHomeBooking;
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
        'selectedStateForHomeBookingUpdated' => 'setSelectedStateForHomeBooking',
        'selectedStateForTestCenterBookingUpdated' => 'setSelectedStateForTestCenterBooking',
        'selectedLocalGovernmentAreaUpdated' => 'setSelectedLocalGovernmentArea',
        'selectedTestTypeUpdated' => 'setSelectedTestType',
    ];

    protected function rules(): array
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

    public function render(): Factory|View|Application
    {
        return view('livewire.forms.book-a-test');
    }

    public function submit()
    {
        try {
            $this->validate();

            $selectedState = match (LocationTypeEnum::from($this->locationType)) {
                LocationTypeEnum::CENTER => $this->selectedStateForTestCenterBooking,
                LocationTypeEnum::HOME => $this->selectedStateForHomeBooking,
            };

            $testType = TestType::find($this->selectedTestType);

            Cart::add(array(
                'id' => 'Test Booking - ' . $testType->test_id,
                'name' => $testType->description,
                'price' => $testType->price,
                'quantity' => 1,
                'attributes' => array(
                    'type' => 'TestBooking',
                    'customerEmail' => $this->customerEmail,
                    'locationType' => $this->locationType,
                    'dueDate' => $this->dueDate,
                    'selectedTestCenter' => $this->selectedTestCenter,
                    'selectedTestType' => $this->selectedTestType,
                    'addressLine1' => $this->addressLine1,
                    'addressLine2' => $this->addressLine2,
                    'city' => $this->city,
                    'selectedState' => $selectedState,
                    'selectedLocalGovernmentArea' => $this->selectedLocalGovernmentArea,
                ),
            ));
            Session::put('customerEmail', $this->customerEmail);
            TestAddedToCartEvent::dispatch();

            $this->flash('success', FlashMessageHelper::TEST_BOOKING_SUCCESSFUL, [], '/');
        }
        catch (\Exception $e) {
            $this->alert('error', FlashMessageHelper::GENERAL_ERROR);
        }

    }

    public function setSelectedTestCenter($object)
    {
        $this->selectedTestCenter = $object['value'];
    }

    public function setSelectedStateForTestCenterBooking($object)
    {
        $this->selectedStateForTestCenterBooking = $object['value'];
    }

    public function setSelectedStateForHomeBooking($object)
    {
        $this->selectedStateForHomeBooking = $object['value'];
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
