<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestBooking;
use App\Helpers\FlashMessageHelper;
use App\Events\TestAddedToCartEvent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Requests\StoreTestBookingRequest;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class BookATest extends Component
{
    use LivewireAlert;

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
    private bool $success = false;
    private ?TestBooking $testBooking = null;

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
        $initialCartItemCount = Cart::getContent()->count();

        Cart::add(array(
            'id' => 'Test Booking - ' . $this->testBooking->id,
            'name' => $this->testBooking->testType->description,
            'price' => $this->testBooking->testType->price,
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
                'selectedState' => $this->selectedState,
                'selectedLocalGovernmentArea' => $this->selectedLocalGovernmentArea,
            ),
        ));

        $finalCartItemCount = Cart::getContent()->count();

        $this->success = $initialCartItemCount > $finalCartItemCount;

        if ($this->success) {

            TestAddedToCartEvent::dispatch();

            $this->flash('success', FlashMessageHelper::TEST_BOOKING_SUCCESSFUL, [], '/');

        }
        else {
            $this->alert('error', FlashMessageHelper::GENERAL_ERROR);
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
