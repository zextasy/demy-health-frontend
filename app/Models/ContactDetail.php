<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactDetail extends BaseModel
{
    use HasFactory;

    //region CONFIG
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
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
