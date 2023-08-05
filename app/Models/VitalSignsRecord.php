<?php

namespace App\Models;

use App\Traits\Relationships\BelongsToVisit;
use App\Traits\Relationships\BelongsToPatient;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VitalSignsRecord extends BaseModel
{
    use HasFactory;
	use BelongsToPatient;
	use BelongsToVisit;

//region CONFIG
    protected $guarded = ['id'];
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
