<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\TestCenter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as Controller;

class BackendController extends Controller
{
    public function info()
    {
        $fullPDOInfo = DB::connection()->getPDO();
        $PDODriverInfo = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);

        $data['fullPDOInfo'] = $fullPDOInfo;
        $data['PDODriverInfo'] = $PDODriverInfo;

        return view('backend.info', $data);
    }

    public function checkOut()
    {
        return redirect()->back();
    }

    public function clear(TestCenter $testCenter)
    {
        \Cart::clear();
        return redirect()->back();
    }

}
