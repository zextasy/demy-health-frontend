<?php

namespace App\Filament\Actions\Pages\Payments;

use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use App\Filament\Actions\Pages\BasePageAction;
use App\Contracts\TransactionCreditableContract;
use App\Actions\Payments\AttachPaymentToPayablesAction;

class AttachExistingPaymentAction extends BasePageAction
{
    private ?TransactionCreditableContract $creditable = null;

    private array $availablePayments = [];

    public static function getDefaultName(): ?string
    {
        return 'Attach Existing Payment';
    }

    protected function setUp(): void
    {
        //TODO issues populating the select after this runs - fix later if necessary
        parent::setUp();
        $this->icon('heroicon-o-cash')
            ->form([
                Select::make('payment_id')
                    ->label('Payment')
                    ->options($this->availablePayments)
                    ->required(),
            ])->action(function (array $data): void {
                $this->runAction($data) ? $this->success() : $this->failure();
            });
    }

    public function creditable(TransactionCreditableContract $creditable): self
    {
        $this->creditable = $creditable;

        return $this;
    }

    public function availablePayments(null|array|Collection $payments): self
    {
        if (isset($payments)) {
            $this->availablePayments = $payments instanceof Collection ? $payments->toArray() : $payments;
        }

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            (new AttachPaymentToPayablesAction)
                ->run($data['payment_id'], $this->creditable);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
