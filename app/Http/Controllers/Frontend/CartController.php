<?php

namespace App\Http\Controllers\Frontend;

use App\Models\TestCenter;
use App\Http\Controllers\Controller as Controller;

class CartController extends Controller
{
    public function show()
    {
        return view('frontend.cart-show');
    }

    public function checkOut()
    {
        return view('frontend.cart-checkout');
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->back();
    }

}
