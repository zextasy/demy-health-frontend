<?php

namespace App\Http\Controllers\Frontend;

use App\Models\TestCenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class CartController extends Controller
{
    public function show()
    {
        return view('frontend.cart-show');
    }

    public function checkOut(Request $request)
    {
        $data['customerEmail'] = $request->customer_email;
        return view('frontend.cart-checkout',$data);
    }

    public function clear()
    {
        \Cart::clear();
        return redirect()->back();
    }

}
