<?php

namespace App\Models\Communication;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Communication\CommunicationChannelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailCommunication extends BaseModel
{
    use HasFactory;

//region CONFIG
    protected $guarded = ['id'];
//endregion

//region ATTRIBUTES
    protected function channel(): Attribute
    {
        return Attribute::make(
            get: fn () => CommunicationChannelEnum::EMAIL(),
        );
    }

    protected function contactDetails(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->to,
        );
    }
//endregion

//region HELPERS

//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
