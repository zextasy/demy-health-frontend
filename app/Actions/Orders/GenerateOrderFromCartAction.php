<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Models\Patient;
use App\Models\Product;
use App\Enums\GenderEnum;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Events\CartCheckedOutEvent;
use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Actions\Patients\CreatePatientAction;
use App\Actions\Addresses\CreateAddressAction;
use App\Actions\OrderItems\CreateOrderItemAction;
use App\Actions\Addresses\AttachAddressableAction;
use App\Actions\TestBookings\CreateTestBookingAction;

class GenerateOrderFromCartAction
{

    private Order $order;

    public function run(CartCollection $cartItems, string $customerEmail): Order
    {
        //TODO move model extraction here and pass to CreateOrderAction
        $this->order = new Order;
        $user = auth()->user();

        DB::transaction(function () use ($user, $customerEmail, $cartItems) {
            $cartItemModelCollection = new Collection();
            foreach ($cartItems as $cartItem) {
                // model, name, price, qty
                $orderableItemCollection = collect(
                    [
                        'model' => $this->getModelForCartItem($cartItem),
                        'name' => $cartItem->name,
                        'price' => floatval($cartItem->price),
                        'quantity' => $cartItem->quantity,
                    ]
                );
                $cartItemModelCollection->push($orderableItemCollection);
            }
            $this->order = (new CreateOrderAction)->run($cartItemModelCollection, $customerEmail, $user);
        });


        $this->raiseEvents();

        return $this->order;
    }

    private function getModelForCartItem(mixed $cartItem): Model
    {
        return match ($cartItem->attributes->type) {
            TestBooking::class => $this->getTestBookingFromCartItem($cartItem),
            Product::class => $cartItem->associatedModel,
        };

    }

    private function getTestBookingFromCartItem(mixed $cartItem): TestBooking
    {
        $patientDetails = $cartItem->attributes->customerEmail ?? $cartItem->attributes->customerPhoneNumber;
        $TestBookingPatient = Patient::withCustomerDetails($patientDetails)->first();
        if (empty($TestBookingPatient)) {
            $customerDateOfBirth = isset($customerDateOfBirth) ? Carbon::parse($cartItem->attributes->customerDateOfBirth) : null;
            $TestBookingPatient = (new CreatePatientAction)
                ->withContactDetails($cartItem->attributes->customerEmail, $cartItem->attributes->customerPhoneNumber)
                ->withAgeDetails(null,$customerDateOfBirth,null)
                ->withCountryDetails($cartItem->attributes->customerCountryId,$cartItem->attributes->customerPassportNumber)
                ->run($cartItem->attributes->customerFirstName, $cartItem->attributes->customerLastName, $cartItem->attributes->customerGender);
        }
        $locationTypeEnum = LocationTypeEnum::from($cartItem->attributes->locationType);
        $dueDate = Carbon::parse($cartItem->attributes->dueDate);
        $testBooking = (new CreateTestBookingAction)
            ->atTestCenter($cartItem->attributes->selectedTestCenter)
            ->forPatient($TestBookingPatient)
            ->withCustomerCommunicationDetails($cartItem->attributes->customerEmail, $cartItem->attributes->customerPhoneNumber)
            ->run(
                $cartItem->attributes->selectedTestType, $locationTypeEnum, $dueDate
            );
        if ($locationTypeEnum == LocationTypeEnum::HOME) {
            $address = (new CreateAddressAction)->run(
                $cartItem->attributes->addressLine1,
                $cartItem->attributes->addressLine2,
                $cartItem->attributes->city,
                $cartItem->attributes->selectedLocalGovernmentArea,
                $cartItem->attributes->selectedState
            );
            (new AttachAddressableAction)->run($address, $testBooking);
        }

        return $testBooking;
    }

    private function raiseEvents()
    {
        CartCheckedOutEvent::dispatch($this->order);
    }

}
