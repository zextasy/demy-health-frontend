<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('frontend.cart-show');
    }

    public function checkOut(Request $request)
    {
        $data['customerEmail'] = $request->customer_email;
        $data['paymentMethod'] = $request->payment_method;

        return view('frontend.cart-checkout', $data);
    }

    public function clear()
    {
        \Cart::clear();

        return redirect()->back();
    }
}
