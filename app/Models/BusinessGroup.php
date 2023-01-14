<?php

namespace App\Models;

use App\Traits\Relationships\BelongsToSelf;
use App\Queries\BusinessGroups\GetBusinessGroupsQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\BusinessGroups\BusinessGroupHierarchyDirectionEnum;

class BusinessGroup extends BaseModel
{
    use HasFactory;
    use BelongsToSelf;

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

    public function isParentOfBusinessGroup(self|int $childBusinessGroup): bool
    {

        return $this->isParentOf($childBusinessGroup);
    }

    public function isAncestorOfBusinessGroup(self|int $childBusinessGroup): bool
    {
        $childBusinessGroupParentId = $childBusinessGroup instanceof self ?
            $childBusinessGroup->parent_id : $childBusinessGroup;
        $ancestralBusinessGroups = (new GetBusinessGroupsQuery())
            ->forBusinessGroup($childBusinessGroupParentId, BusinessGroupHierarchyDirectionEnum::UP)
            ->query();

        return $ancestralBusinessGroups->contains($this);
    }

    public function isChildOfBusinessGroup(self|int $parentBusinessGroup): bool
    {
        return $this->isChildOf($parentBusinessGroup);
    }

    public function isDescendantOfBusinessGroup(self|int $parentBusinessGroup): bool
    {
        $parentBusinessGroupId = $parentBusinessGroup instanceof self ? $parentBusinessGroup->id : $parentBusinessGroup;
        $descendantBusinessGroups = (new GetBusinessGroupsQuery())
            ->forBusinessGroup($parentBusinessGroupId, BusinessGroupHierarchyDirectionEnum::DOWN)
            ->includeCurrentBusinessGroup()
            ->query();

        return $descendantBusinessGroups->contains($this);
    }
    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS

    //endregion
    protected function getLocalForeignKey(): string
    {
        return 'parent_id';
    }
}
