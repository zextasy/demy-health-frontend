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
use Illuminate\Validation\ValidationException;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Foundation\Application;
use App\Traits\Livewire\ManipulatesCustomerSession;

class BookATest extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $selectedTestCenter;
    public $selectedCustomerCountry;
    public $selectedCustomerGender;
    public $selectedStateForTestCenterBooking;
    public $selectedStateForHomeBooking;
    public $selectedLocalGovernmentArea;
    public $selectedTestType;
    public $customerFirstName = null;
    public $customerLastName = null;
    public $customerEmail = null;
    public $customerPhoneNumber = null;
    public $locationType = null;
    public $addressLine1 = null;
    public $addressLine2 = null;
    public $city = null;
    public $dueDate;
    public $startTime;
    public $customerGender = null;
    public $customerDateOfBirth = null;
    public $customerCountryId = null;
    public $customerPassportNumber = null;

    protected $listeners = [
        'selectedTestCenterUpdated' => 'setSelectedTestCenter',
        'selectedStateForHomeBookingUpdated' => 'setSelectedStateForHomeBooking',
        'selectedStateForTestCenterBookingUpdated' => 'setSelectedStateForTestCenterBooking',
        'selectedLocalGovernmentAreaUpdated' => 'setSelectedLocalGovernmentArea',
        'selectedTestTypeUpdated' => 'setSelectedTestType',
        'postBookingCart' => 'goToCart',
        'postBookingHome' => 'goHome',
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
        $this->customerEmail = $this->getSessionCustomerEmail();
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
                'name' => $testType->name,
                'price' => $testType->price,
                'quantity' => 1,
                'attributes' => array(
                    'type' => 'TestBooking',
                    'customerFirstName' => $this->customerFirstName,
                    'customerLastName' => $this->customerLastName,
                    'customerEmail' => $this->customerEmail,
                    'customerPhoneNumber' => $this->customerPhoneNumber,
                    'customerGender' => $this->customerGender,
                    'customerDateOfBirth' => $this->customerDateOfBirth,
                    'customerCountryId' => $this->customerCountryId,
                    'customerPassportNumber' => $this->customerPassportNumber,
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
            $this->setSessionCustomerEmail($this->customerEmail);
            TestAddedToCartEvent::dispatch();

            $this->alert('success', FlashMessageHelper::TEST_BOOKING_SUCCESSFUL, [
                'position' => 'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'View Cart',
//                'showDenyButton' => true,
//                'denyButtonText' => 'Cancel',
                'showCancelButton' => true,
                'cancelButtonText' => 'Home',
                'onConfirmed' => 'postBookingCart',
                'onDismissed' => 'postBookingHome',
                'allowOutsideClick' => false,
                'timer' => null
            ]);
        }
        catch (ValidationException $e) {
            $this->alert('error', $e->getMessage());
        }
        catch (\Exception $e) {
            $this->alert('error', "Something went wrong");
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

    public function goToCart()
    {
        $this->redirect(route('frontend.cart.display'));
    }

    public function goHome()
    {
        $this->redirect(route('home'));
    }

}
