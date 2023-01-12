<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Contracts\VirtualFieldableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\morphToMany;

class TestResultTemplate extends BaseModel implements VirtualFieldableContract
{
    use HasFactory;

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
    public function virtualFields(): morphToMany
    {
        return $this->morphToMany(VirtualField::class, 'virtual_fieldable')
//            ->withPivot(['display_weight','is_required','is_searchable','should_display_on_index'])
            ->using(VirtualFieldable::class);
    }
    //endregion

}
