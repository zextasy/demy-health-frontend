<?php

namespace App\Models\Communication;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\Communication\CommunicationChannelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsCommunication extends BaseModel
{
    use HasFactory;

//region CONFIG
    protected $guarded = ['id'];
//endregion

//region ATTRIBUTES
    protected function channel(): Attribute
    {
        return Attribute::make(
            get: fn () => CommunicationChannelEnum::SMS(),
        );
    }

    protected function contactDetails(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->phone_number,
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
