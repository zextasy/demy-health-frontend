<?php

namespace App\Traits\Models;

use App\Helpers\ModelHelper;
use Illuminate\Database\Eloquent\Model;

trait GeneratesReference
{
    public static function bootGeneratesReference()
    {
        static::creating(function (Model $model) {
            $config = $model->referenceConfig();
            $prefix = $config['reference_prefix'];
            $key = $config['reference_key'];
            if (empty($model->$key)) {
                $nextId = (new ModelHelper)->getNextId($model);
                $padding = str_pad($nextId, 9, '0', STR_PAD_LEFT);
                $model->$key = $prefix.$padding;
            }
        });
    }

    abstract public function referenceConfig(): array;

    public function scopeWithIdOrReference($query, null|string|int $id)
    {
        $config = $this->referenceConfig();
        $key = $config['reference_key'];

        return $query->where($key, '=', $id)
            ->orWhere('id', '=', $id);
    }
}
