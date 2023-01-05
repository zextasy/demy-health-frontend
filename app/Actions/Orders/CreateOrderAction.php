<?php

namespace App\Actions\Orders;

use App\Models\Finance\Discount;
use App\Contracts\DiscounterContract;
use App\Actions\OrderItems\CreateOrderItemAction;
use App\Contracts\OrderableCustomerContract;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Events\OrderCreatedEvent;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Actions\Discounts\LinkDiscountableAction;

class CreateOrderAction
{
    private Order $order;

    private ?DiscounterContract $discounter = null;

    private ?Collection $discounts = null;

    public function run(
        Collection $orderItems,
        ?string $customerEmail,
        OrderableCustomerContract $orderableCustomer = null
    ): Order
    {
        $this->order = new Order;
        $this->order->customer_email = $customerEmail ?? config('constants.default_email');
        $this->order->customer_id = $orderableCustomer?->getLaravelMorphModelId();
        $this->order->customer_type = $orderableCustomer?->getLaravelMorphModelType();
        DB::transaction(function () use ($orderItems) {
            $this->order->save();
            foreach ($orderItems as $orderableItemCollection) {
                (new CreateOrderItemAction)
                    ->run(
                        $this->order,
                        $orderableItemCollection->get('model'),
                        $orderableItemCollection->get('quantity'),
                        $orderableItemCollection->get('name'),
                        floatval($orderableItemCollection->get('price'))
                    );
            }
            $this->applyApplicableDiscounts();


        });

        $this->raiseEvents();

        return $this->order;
    }

    public function withDiscounter(?DiscounterContract $discounter): self
    {
        $this->discounter = $discounter;
        return $this;
    }

    public function withDiscounts(null|Discount|Collection $discounts): self
    {
        $this->discounts = $discounts instanceof Discount ? collect([$discounts]) : $discounts;
        return $this;
    }

    private function raiseEvents()
    {
        OrderCreatedEvent::dispatch($this->order);
    }

    private function applyApplicableDiscounts()
    {
        $applicableDiscounts = collect([]);

        if (isset($this->discounter)) {
            $applicableDiscounts = $applicableDiscounts->merge($this->discounter->getApplicableDiscounts());
        }

        if (isset($this->discounts)) {
            $applicableDiscounts = $applicableDiscounts->merge($this->discounts);
        }

        $linkDiscountableAction = new LinkDiscountableAction();
        foreach ($applicableDiscounts as $discount) {
            $linkDiscountableAction->run($discount, $this->order);
        }
    }
}
