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
        return get_class($model)::query()->withThrashed()->count() + 1;
    }

    public function getNextId(Model $model)
    {
        $nextId = $this->getNextIdFromDb($model->getTable());
        $existingModel = get_class($model)::where('id', $nextId)->exists();

        if (! $existingModel) {
            return $nextId;
        }

        $nextId = $this->getNextIdFromModelCount($model);
        $existingModel = get_class($model)::where('id', $nextId)->exists();
        if (! $existingModel) {
            return $nextId;
        }

        return floor(time() - 999999999);
    }
}
