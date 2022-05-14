<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use PDO;

class HerokuHelper
{
    public static function isRunningHeroku() :bool
    {
        if (DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql') {
            return false;
        }

        return true;
    }
}
