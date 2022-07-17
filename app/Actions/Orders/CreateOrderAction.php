<?php

namespace App\Actions\Orders;

use App\Models\User;
use App\Models\Order;
use App\Models\Patient;
use App\Models\TestBooking;
use Illuminate\Support\Carbon;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Contracts\OrderableContract;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Actions\Patients\CreatePatientAction;
use App\Actions\Addresses\CreateAddressAction;
use App\Actions\OrderItems\CreateOrderItemAction;
use App\Actions\Addresses\AttachAddressableAction;
use App\Actions\TestBookings\CreateTestBookingAction;

class CreateOrderAction
{

    private Order $order;

    public function run(Collection $orderItems, string $customerEmail, ?OrderableContract $orderable): Order
    {
        $this->order = new Order;
        $this->order->customer_email = $customerEmail;
        $this->order->orderable_id = $orderable?->id;
        $this->order->orderable_type = isset($orderable) ? get_class($orderable) : null;
        DB::transaction(function () use ($orderItems) {
            $this->order->save();
            foreach ($orderItems as $cartItem) {
                $this->generateOrderItemFromCartItem($cartItem, $this->order);
            }
        });

        $this->raiseEvents();

        return $this->order;
    }

    private function generateOrderItemFromCartItem(mixed $cartItem, Order $order): void
    {
        $orderableItem = match ($cartItem->attributes->type) {
            "TestBooking" => $this->getTestBookingFromCartItem($cartItem),
            "Product" => $cartItem->associatedModel,
        };
        (new CreateOrderItemAction)
            ->run(
                $order,
                $orderableItem,
                $cartItem->name,
                floatval($cartItem->price),
                $cartItem->quantity
            );
    }

    private function getTestBookingFromCartItem(mixed $cartItem): TestBooking
    {
        $TestBookingPatient = Patient::query()
            ->where('email', $cartItem->attributes->customerEmail)
            ->orWhere('phone_number',$cartItem->attributes->customerPhoneNumber)
            ->first();
        if (empty($TestBookingPatient)) {
            $customerDateOfBirth = isset($customerDateOfBirth) ? Carbon::parse($cartItem->attributes->customerDateOfBirth) :null;
            $TestBookingPatient = (new CreatePatientAction)
                ->withContactDetails($cartItem->attributes->customerEmail, $cartItem->attributes->customerPhoneNumber)
                ->withAgeDetails(null,$customerDateOfBirth,null)
                ->withCountryDetails($cartItem->attributes->customerCountryId,$cartItem->attributes->customerPassportNumber)
                ->run($cartItem->attributes->customerFirstName, $cartItem->attributes->customerLastName, $cartItem->attributes->customerGender);
        }
        $locationTypeEnum = LocationTypeEnum::from($cartItem->attributes->locationType);
        $dueDate = Carbon::parse($cartItem->attributes->dueDate);
        $orderableItem = (new CreateTestBookingAction)
            ->atTestCenter($cartItem->attributes->selectedTestCenter)
            ->forPatient($TestBookingPatient)
            ->run(
                $cartItem->attributes->selectedTestType,
                $cartItem->attributes->customerEmail, $locationTypeEnum, $dueDate
            );
        if ($locationTypeEnum == LocationTypeEnum::HOME) {
            $address = (new CreateAddressAction)->run(
                $cartItem->attributes->addressLine1,
                $cartItem->attributes->addressLine2,
                $cartItem->attributes->city,
                $cartItem->attributes->selectedState,
                $cartItem->attributes->selectedLocalGovernmentArea
            );
            (new AttachAddressableAction)->run($address, $orderableItem);
        }

        return $orderableItem;
    }

    private function raiseEvents()
    {
        OrderCreatedEvent::dispatch($this->order);
    }

}
