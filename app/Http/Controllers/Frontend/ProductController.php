<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller as Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): Response
    {
        return view('frontend.pharmaceuticals');
    }

    public function show(Product $product): Response
    {
        return view('frontend.pharmaceuticals');
    }

    public function allProducts()
    {
        $products = Product::query()->inRandomOrder()->limit(5)->get();

        $data['products'] = $products;

        return view('frontend.all-products', $data);
    }

    public function pcrAndReagents()
    {
        return view('frontend.pcr-and-reagents');
    }

    public function hospitalAndLaboratoryProducts()
    {
        return view('frontend.hospital-and-laboratory-products');
    }

    public function pharmaceuticals()
    {
        return view('frontend.pharmaceuticals');
    }

    public function procurementAndSupply()
    {
        return view('frontend.procurement-and-supply');
    }
}
