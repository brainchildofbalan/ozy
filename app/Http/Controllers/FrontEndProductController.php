<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class FrontEndProductController extends Controller
{
    public function index()
    {
        $sub_url = null;
        $url = null;

        $products = Products::orderBy('id', 'desc')->get();





        $categories = ProductSubCategory::all();
        // $categoriesMain = ProductCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.products.view', compact('products', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function category($url)
    {
        $sub_url = null;
        $get_category_id = ProductCategory::where('url', $url)->first();
        $products = Products::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::where('relative_category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ProductCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.products.view', compact('products', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function SubCategory($url, $sub_url)
    {

        $get_category_id = ProductCategory::where('url', $url)->first();
        $get_sub_category_id = ProductSubCategory::where('url', $sub_url)->first();
        $products = Products::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->where('sub_category_id', $get_sub_category_id->category_id . ',' . $get_sub_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::where('relative_category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ProductCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.products.view', compact('products', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function fetchAll($id)
    {
        $category = Products::where('product_code', $id)->first();;
        return response()->json(['data' => $category]);
    }



    public function fetchSingle($url, $sub_url, $product)
    {
        $products = Products::where('url', $product)->first();
        return view('front-end.products-details.view', compact('products'));
    }
}
