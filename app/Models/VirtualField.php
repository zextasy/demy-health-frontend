<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Enums\FieldTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VirtualField extends BaseModel
{
    use HasFactory;

//region CONFIG
    protected $guarded = ['id'];
    protected $casts = [
        'options' => 'array',
        'field_type' => FieldTypeEnum::class,
    ];
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS

//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
