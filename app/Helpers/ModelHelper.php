<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use PDO;

class ModelHelper
{
    public function getNextId($tableName)
    {
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME)) {
            case 'mysql':
                $statement = DB::select("show table status like '{$tableName}'");
                return $statement[0]->Auto_increment;

            default:
                return floor(time() - 999999999);
        }
    }
}
