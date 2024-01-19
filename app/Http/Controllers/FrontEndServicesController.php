<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ProductSubCategory;
use App\Models\Services;
use App\Models\ServicesCategory;
use Illuminate\Http\Request;

class FrontEndServicesController extends Controller
{
    public function index()
    {
        $sub_url = null;
        $url = null;
        $services = Services::orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::all();
        // $categoriesMain = ServicesCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.services.view', compact('services', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function category($url)
    {
        $sub_url = null;
        $get_category_id = ServicesCategory::where('url', $url)->first();
        $services = Services::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ServicesCategory::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ServicesCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.services.view', compact('services', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function SubCategory($url, $sub_url)
    {

        $get_category_id = ServicesCategory::where('url', $url)->first();
        $get_sub_category_id = ProductSubCategory::where('url', $sub_url)->first();
        $products = Services::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->where('sub_category_id', $get_sub_category_id->category_id . ',' . $get_sub_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::where('relative_category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ServicesCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.products.view', compact('products', 'categories', 'categoriesMain', 'url', 'sub_url'));
    }

    public function fetchSingle($url, $services)
    {
        $services = Services::where('url', $services)->first();
        return view('front-end.service-details.view', compact('services'));
    }
}
