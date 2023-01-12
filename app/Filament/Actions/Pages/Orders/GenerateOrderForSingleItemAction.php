<?php

namespace App\Filament\Actions\Pages\Orders;

use App\Models\Order;
use App\Contracts\OrderableItemContract;
use App\Filament\Resources\OrderResource;
use App\Filament\Actions\Pages\BasePageAction;
use App\Actions\Orders\GenerateOrderFromTestBookingAction;

class GenerateOrderForSingleItemAction extends BasePageAction
{
    private ?OrderableItemContract $subject = null;
    private ?Order $order = null;

    public static function getDefaultName(): ?string
    {
        return 'assign task';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->requiresConfirmation()
            ->icon('heroicon-o-lightning-bolt')
            ->action(function (): void {
                $this->successRedirectUrl(OrderResource::getUrl('view', ['record' => $this->order->id]));
                $this->runAction() ? $this->success() : $this->failure();


            });
    }

    public function subject(OrderableItemContract $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(): bool
    {
        try {
            $this->order = (new GenerateOrderFromTestBookingAction)->run($this->subject);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
