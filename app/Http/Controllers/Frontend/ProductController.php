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
        $products = Product::with(['media','currentPrice'])->inRandomOrder()->limit(5)->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }

    public function viewProduct( int $id)
    {
        $product = Product::findOrFail($id);
        $data['product'] = $product;
        return view('frontend.product-detail', $data);
    }

    public function pcrAndReagents()
    {
        $category = ProductCategory::query()->where('name','PCR and Reagents')->firstOrFail();
        $productQuery = $category->products()->count() > 0 ? $category->products(): Product::query()->inRandomOrder()->limit(15);
        $products = $productQuery->with(['media','currentPrice'])->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }

    public function hospitalAndLaboratoryProducts()
    {
        $category = ProductCategory::query()->where('name','Hospital and Laboratory Products')->first();
        $productQuery = $category->products()->count() > 0 ? $category->products(): Product::query()->inRandomOrder()->limit(15);
        $products = $productQuery->with(['media','currentPrice'])->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }

    public function pharmaceuticals()
    {
        $category = ProductCategory::query()->where('name','Pharmaceuticals')->first();
        $productQuery = $category->products()->count() > 0 ? $category->products(): Product::query()->inRandomOrder()->limit(15);
        $products = $productQuery->with(['media','currentPrice'])->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }

    public function procurementAndSupply()
    {
        $category = ProductCategory::query()->where('name','Procurement and Supply')->first();
        $productQuery = $category->products()->count() > 0 ? $category->products(): Product::query()->inRandomOrder()->limit(15);
        $products = $productQuery->with(['media','currentPrice'])->get();

        $data['products'] = $products;

        return view('frontend.product-listing', $data);
    }
}
