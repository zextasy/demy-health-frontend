<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TestResultTemplate extends BaseModel
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
    public function virtualFields(): BelongsToMany
    {
        return $this->belongsToMany(VirtualField::class)
//            ->withPivot(['display_weight','is_required','is_searchable','should_display_on_index'])
            ->using(TestResultTemplateVirtualField::class);
    }
    //endregion

}
