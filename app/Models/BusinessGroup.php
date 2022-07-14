<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Queries\BusinessGroups\GetBusinessGroupsQuery;
use App\Enums\BusinessGroups\BusinessGroupHierarchyDirectionEnum;

class BusinessGroup extends BaseModel
{
    use HasFactory;

//region CONFIG
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS
    public static function root(): ?self
    {
        return self::whereNull('parent_id')->first();
    }

    public function isParentOfBusinessGroup($childBusinessGroup): bool
    {
        $childBusinessGroupParentId = $childBusinessGroup instanceof self ? $childBusinessGroup->parent_id : $childBusinessGroup;

        return $this->id == $childBusinessGroupParentId;
    }

    public function isAncestorOfBusinessGroup($childBusinessGroup): bool
    {
        $childBusinessGroupParentId = $childBusinessGroup instanceof self ? $childBusinessGroup->parent_id : $childBusinessGroup;
        $AncestralBusinessGroups = (new GetBusinessGroupsQuery())->forBusinessGroup($childBusinessGroupParentId,
            BusinessGroupHierarchyDirectionEnum::UP)->query();

        return $AncestralBusinessGroups->contains($this);
    }

    public function isChildOfBusinessGroup($parentBusinessGroup): bool
    {
        $parentBusinessGroupId = $parentBusinessGroup instanceof self ? $parentBusinessGroup->id : $parentBusinessGroup;

        return $this->parent_id == $parentBusinessGroupId;
    }

    public function isDescendantOfBusinessGroup($parentBusinessGroup): bool
    {
        $parentBusinessGroupId = $parentBusinessGroup instanceof self ? $parentBusinessGroup->id : $parentBusinessGroup;
        $descendantBusinessGroups = (new GetBusinessGroupsQuery())->forBusinessGroup($parentBusinessGroupId,
            BusinessGroupHierarchyDirectionEnum::DOWN)->includeCurrentBusinessGroup()->query();

        return $descendantBusinessGroups->contains($this);
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function allChildren(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('allChildren');
    }
//endregion

}
