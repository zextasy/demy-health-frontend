<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Models\GeneratesReference;
use App\Contracts\TransactionDebitableContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Relationships\MorphsTransactionsAsDebit;

class Payment extends BaseModel implements TransactionDebitableContract
{
    use HasFactory;
    use BelongsToBusinessGroup;
    use GeneratesReference;
    use MorphsTransactionsAsDebit;
    use LaravelMorphable;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at','exhausted_at'];
    protected $casts = [
        'internal_references' => 'array',
        'metadata' => 'array'
    ];

    protected $with = ['transactions'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->payment_prefix,
        ];
    }
    //endregion

    //region ATTRIBUTES
    public function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getMaximumDebitableAmount(),
        );
    }
    //endregion

    //region HELPERS
    public function getMaximumDebitableAmount(): float
    {
        $value = $this->amount - $this->total_transaction_amount;

        return max($value, 0);
    }

    public function hasBeenSettled() : bool
    {
        return !empty($this->exhausted_at);
    }

    public function hasNotBeenSettled() : bool
    {
        return !$this->hasBeenSettled();
    }

    public function updatePaymentStatus(): void
    {
        if ($this->balance < 1 && empty($this->payment_received_at)) {
            $this->update(['exhausted_at' => now()]);
        }
    }
    //endregion

    //region SCOPES

    public function scopeHasBeenSettled($query)
    {
        return $query->whereNotNull('exhausted_at');
    }

    public function scopeHasNotBeenSettled($query)
    {
        return $query->whereNull('exhausted_at');
    }
    public function scopeNeedsProcessing($query)
    {
        return $query->whereNotNull('internal_references')->hasNotBeenSettled();
    }
    //endregion

    //region RELATIONSHIPS

    public function payer() : MorphTo
    {
        return $this->morphTo('payer');
    }

    //endregion
}
