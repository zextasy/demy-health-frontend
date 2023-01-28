<?php

namespace App\Models\Communication;

use App\Models\BaseModel;
use App\Helpers\CommunicationSettingsHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Enums\Communication\CommunicationStatusEnum;
use App\Enums\Communication\CommunicationChannelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Communication extends BaseModel
{
    use HasFactory;

    //region CONFIG
    protected $guarded = ['id'];

    protected $casts = [
        'status' => CommunicationStatusEnum::class,
    ];

    protected $with = ['communication'];

    protected $appends = ['channel','content','contact_details','contact_name'];
    //endregion

    //region ATTRIBUTES contact details

    protected function channel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->communication->channel,
        );
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->communication->content,
        );
    }

    protected function contactName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->communicable->full_name,
        );
    }

    protected function contactDetails(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->communication->contact_details,
        );
    }
    //endregion

    //region HELPERS
    public function logSendFailure()
    {
        $this->tries++;
        $this->status = $this->tries >= CommunicationSettingsHelper::maximumTriesForChannel($this->channel)
            ? CommunicationStatusEnum::FAILED
            : CommunicationStatusEnum::PERMANENT_FAILURE;
        $this->save();
    }

    public function logSendSuccess()
    {
        $this->status = CommunicationStatusEnum::SUCCESSFUL;
        $this->save();
    }

    public function sendingHasPermanentlyFailed(string $channel): bool
    {
        return $this->status == CommunicationStatusEnum::PERMANENT_FAILURE;
    }

    public function sendingHasNotPermanentlyFailed(string $channel): bool
    {
        return !$this->sendingHasPermanentlyFailed($channel);
    }

    public function hasBeenSent(string $channel): bool
    {
        return $this->status == CommunicationStatusEnum::SUCCESSFUL;
    }

    public function canBeSent(): bool
    {
        return $this->status->notIn([CommunicationStatusEnum::Sent(), CommunicationStatusEnum::Cancelled()]);
    }

    public function canNotBeSent(): bool
    {
        return !$this->canBeSent();
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function communication(): MorphTo
    {
        return $this->morphTo();
    }

    public function communicable(): MorphTo
    {
        return $this->morphTo();
    }
    //endregion

}
