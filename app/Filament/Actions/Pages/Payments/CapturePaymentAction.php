<?php

namespace App\Filament\Actions\Pages\Payments;

use App\Contracts\PayerContract;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Actions\Payments\CreatePaymentAction;
use App\Filament\Actions\Pages\BasePageAction;
use App\Contracts\TransactionCreditableContract;
use App\Enums\Finance\Payments\PaymentMethodEnum;

class CapturePaymentAction extends BasePageAction
{
    private ?PayerContract $payer = null;

    private ?TransactionCreditableContract $creditable = null;

    public static function getDefaultName(): ?string
    {
        return 'Capture Payment';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-o-cash')
            ->form([
                TextInput::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->required(),
                Select::make('method')
                    ->label('Payment Method')
                    ->options(PaymentMethodEnum::optionsAsSelectArray())
                    ->searchable()
                    ->required(),
            ])->action(function (array $data): void {
                $this->runAction($data) ? $this->success() : $this->failure();
            });
    }

    public function payer(?PayerContract $payer): self
    {
        $this->payer = $payer;

        return $this;
    }

    public function creditable(TransactionCreditableContract $payable): self
    {
        $this->creditable = $payable;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            (new CreatePaymentAction)
                ->paidBy($this->payer)
                ->withInternalReferences($this->creditable?->getPayableReference())
                ->withCustomerEmail($this->creditable?->getEmailForPayment())
                ->run($data['amount'], $data['method']);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
