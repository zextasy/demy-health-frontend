<?php

namespace App\Filament\Actions\Pages\Discounts;

use App\Models\Finance\Discount;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Select;
use App\Contracts\DiscounterContract;
use App\Actions\Discounts\LinkDiscounterAction;

class AttachDiscountAction extends Action
{

    private ?DiscounterContract $subject = null;

    public static function getDefaultName(): ?string
    {
        return 'Attach Discount';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-credit-card')
            ->form([
                Select::make('discount_id')
                    ->label('Discount')
                    ->options(Discount::all()->toSelectArray())
                    ->searchable()
                    ->required(),
            ])->action(function (array $data): void {
                $this->runAction($data) ? $this->success() : $this->failure();
            });
    }

    public function subject(DiscounterContract $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    protected function runAction(array $data): bool
    {
        try {
            (new LinkDiscounterAction)
                ->run($data['discount_id'], $this->subject);
            return true;
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
