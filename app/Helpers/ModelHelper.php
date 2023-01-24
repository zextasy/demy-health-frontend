<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class ModelHelper
{
    private function getNextIdFromDb($tableName)
    {
        switch (DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME)) {
            case 'mysql':
                $statement = DB::select("show table status like '{$tableName}'");

                return $statement[0]->Auto_increment;
            case 'pgsql':
            default:
                return floor(time() - 999999999);
        }
    }
    private function getNextIdFromModelCount(Model $model): int
    {
        return get_class($model)::withTrashed()->count() + 1;
    }

    private function getNextIdForMonth(Model $model): int
    {
        return get_class($model)::withTrashed()->whereMonth('created_at', '=', now()->month)->count() + 1;
    }

    public function getNextId(Model $model): string
    {
        $nextId = $this->getNextIdFromDb($model->getTable());
        $existingModel = get_class($model)::withThrashed()->where('id', $nextId)->exists();

        if (! $existingModel) {
            return $nextId;
        }

        $nextId = $this->getNextIdFromModelCount($model);
        $existingModel = get_class($model)::withThrashed()->where('id', $nextId)->exists();
        if (! $existingModel) {
            return $nextId;
        }

        return floor(time() - 999999999);
    }

    public function getNextReference(Model $model, string $prefix, string $key): string
    {
        $nextId = $this->getNextId($model);
        $padding = str_pad($nextId, 9, '0', STR_PAD_LEFT);
//        $currentDate = now();
//        $reference = $prefix.$currentDate->year.'-'.$currentDate->month.'-'.$padding;
        $reference = $prefix.$padding;

        if (get_class($model)::withThrashed()->where($key, $reference)->exists()) {
            $reference = $reference.'-'.$nextId;
        }

        return $reference;
    }
}
