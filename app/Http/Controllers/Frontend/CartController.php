<?php

namespace App\Http\Controllers\Frontend;

use App\Models\TestCenter;
use App\Http\Controllers\Controller as Controller;

class CartController extends Controller
{
    public function show()
    {
        return view('frontend.show-cart');
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
