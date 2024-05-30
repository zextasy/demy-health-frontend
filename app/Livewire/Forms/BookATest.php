<?php

namespace App\Livewire\Forms;

use App\Models\State;
use App\Models\Country;
use App\Models\TestCenter;
use App\Models\LocalGovernmentArea;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Events\TestAddedToCartEvent;
use App\Helpers\FlashMessageHelper;
use App\Http\Requests\StoreTestBookingRequest;
use App\Models\TestBooking;
use App\Models\TestType;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class BookATest extends Component
{
    use LivewireAlert, ManipulatesCustomerSession;

    public $testTypes = [];
    public $countries = [];
    public $statesForHomeBooking = [];
    public $statesForCenterBooking = [];

    public $localGovernmentAreas = [];

    public $testCenters = [];
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
        $this->testTypes = TestType::all()->pluck('name','id')->toArray();
        $this->countries = Country::all()->pluck('name','id')->toArray();
        $this->statesForHomeBooking = State::query()->isReadyForSampleCollection()->pluck('name','id')->toArray();
        $this->statesForCenterBooking = State::query()->has('testCenters')->pluck('name','id')->toArray();
        $this->customerEmail = $this->getSessionCustomerEmail();
    }

    public function hydrate()
    {
        // Runs at the beginning of every "subsequent" request...
        // This doesn't run on the initial request ("mount" does)...
        if (isset($this->selectedStateForHomeBooking)){
            $this->localGovernmentAreas = LocalGovernmentArea::query()->where('state_id', $this->selectedStateForHomeBooking)->pluck('name','id')->toArray();
        }
        if (isset($this->selectedStateForTestCenterBooking)){
            $this->testCenters = TestCenter::query()->inState($this->selectedStateForHomeBooking)->pluck('name','id')->toArray();
        }
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

            Cart::add([
                'id' => 'Test Booking - '.$testType->test_id,
                'name' => $testType->name,
                'price' => $testType->price,
                'quantity' => 1,
                'attributes' => [
                    'type' => TestBooking::class,
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
                ],
            ]);
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
                'timer' => null,
            ]);
        } catch (ValidationException $e) {
            $this->alert('error', $e->getMessage());
        } catch (\Exception $e) {
            $this->alert('error', 'Something went wrong');
        }
    }

    public function updatedSelectedStateForTestCenterBooking($value, $key)
    {
        ray($value, $key);

    }

    public function updatedSelectedStateForHomeBooking($value, $key)
    {
        ray($value, $key);

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
