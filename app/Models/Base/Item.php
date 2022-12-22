<?php

namespace App\Models\Base;

use App\Models\BaseModel;

class Item extends BaseModel
{

    //region CONFIG

    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    protected function getTotalAmount(): float
    {
        return $this->price * $this->quantity;
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS

    //endregion
}
