<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Response;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller as Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function allProducts()
    {
        $products = Product::with('media')->inRandomOrder()->limit(5)->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }

    public function viewProduct()
    {
        return view('frontend.pcr-and-reagents');
    }

    public function pcrAndReagents()
    {
        $category = ProductCategory::query()->where('name','PCR and Reagents')->firstOrFail();
        $products = $category->products()->with('media')->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
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
