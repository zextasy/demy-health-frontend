<?php

namespace App\Traits\Relationships;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToSelf
{
    abstract protected function getLocalForeignKey(): string;

    public function parent(): BelongsTo
    {
        $foreignKey = $this->getLocalForeignKey();

        return $this->belongsTo(self::class, $foreignKey);
    }

    public function children(): HasMany
    {
        $foreignKey = $this->getLocalForeignKey();

        return $this->hasMany(self::class, $foreignKey);
    }

    public function allChildren(): HasMany
    {
        $foreignKey = $this->getLocalForeignKey();

        return $this->hasMany(self::class, $foreignKey, 'id')->with('allChildren');
    }

    public function isParentOf(Model|int $child): bool
    {
        $foreignKey = $this->getLocalForeignKey();
        $childBusinessGroupParentId = $child instanceof self ? $child->$foreignKey : $child;

        return $this->id == $childBusinessGroupParentId;
    }

    public function isChildOf(Model|int $parent): bool
    {
        $foreignKey = $this->getLocalForeignKey();
        $parentId = $parent instanceof self ? $parent->id : $parent;

        return $this->$foreignKey == $parentId;
    }
}
