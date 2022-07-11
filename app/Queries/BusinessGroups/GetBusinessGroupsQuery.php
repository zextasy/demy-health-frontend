<?php

namespace App\Queries\BusinessGroups;


use App\Models\BusinessGroup;
use App\Support\BaseCollection;
use Illuminate\Support\Facades\Cache;
use App\Enums\BusinessGroups\BusinessGroupHierarchyDirectionEnum;

class GetBusinessGroupsQuery
{
    protected ?BusinessGroupHierarchyDirectionEnum $hierarchyDirection = null;

    protected ?int $businessGroupId = null;

    protected bool $includeCurrentBusinessGroup = false;

    /**
     * @param BusinessGroup|int $businessGroup
     * @param BusinessGroupHierarchyDirectionEnum $hierarchyDirection
     *
     * @return GetBusinessGroupsQuery
     */
    public function forBusinessGroup($businessGroup, BusinessGroupHierarchyDirectionEnum $hierarchyDirection): self
    {
        if ($businessGroup instanceof BusinessGroup) {
            $this->businessGroupId = $businessGroup->id;
        }

        if (is_numeric($businessGroup)) {
            $this->businessGroupId = $businessGroup;
        }

        $this->hierarchyDirection = $hierarchyDirection;

        return $this;
    }

    public function includeCurrentBusinessGroup(bool $shouldInclude = true): self
    {
        $this->includeCurrentBusinessGroup = $shouldInclude;

        return $this;
    }

    public function query(): BaseCollection
    {
        $builder = BusinessGroup::query()
            ->when((! empty($this->hierarchyDirection) && ! empty($this->businessGroupId)), function ($query) {
                return $query
                    ->whereIn('id', $this->getBusinessGroupTreeIds($this->businessGroupId));
            });

        //cache the query for 1 hour
        return $builder->get();
    }

    private function getBusinessGroupTreeIds(int $businessGroupId): array
    {
        return Cache::tags(BusinessGroup::getCacheTagName())
            ->remember("business-unit-tree-for-{$businessGroupId}", now()->addDay(), function () use ( $businessGroupId ) {
            $businessGroup = BusinessGroup::find($businessGroupId);
            $all_ids = $this->includeCurrentBusinessGroup ? [$businessGroupId] : [];

            if ($this->hierarchyDirection == BusinessGroupHierarchyDirectionEnum::DOWN && $businessGroup->allChildren->count() > 0) {
                foreach ($businessGroup->allChildren as $child) {
                    $all_ids[] = $child->id;
                    $all_ids = array_merge($all_ids, is_array($this->getBusinessGroupTreeIds($child->id)) ? $this->getBusinessGroupTreeIds($child->id) : []);
                }
            }

            if ($this->hierarchyDirection == BusinessGroupHierarchyDirectionEnum::UP && ! empty($businessGroup->parent)) {
                $all_ids[] = $businessGroup->parent->id;
                $all_ids = array_merge($all_ids, is_array($this->getBusinessGroupTreeIds($businessGroup->parent->id)) ? $this->getBusinessGroupTreeIds($businessGroup->parent->id) : []);
            }

            return array_unique($all_ids);
        });
    }
}
