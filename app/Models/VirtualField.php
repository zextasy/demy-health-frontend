<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Enums\FieldTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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
    public function testResultTemplates(): MorphToMany
    {
        return $this->morphedByMany(TestResultTemplate::class, 'virtual_fieldable')
//            ->withPivot(['display_weight','is_required','is_searchable','should_display_on_index'])
            ->using(VirtualFieldable::class);
    }
    //endregion

}
