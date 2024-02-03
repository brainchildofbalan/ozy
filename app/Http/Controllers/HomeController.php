<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Products;
use App\Models\ProductSubCategory;
use App\Models\Services;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sub_url = null;
        $url = null;
        $services = Services::where('is_home', 1)->orderBy('id', 'desc')->get();
        $products = Products::where('is_featured', 1)->orderBy('id', 'desc')->get();
        $productsValue = Products::where('is_valuable', 1)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.home.view', compact('services', 'categories', 'categoriesMain', 'url', 'sub_url', 'products', 'productsValue'));
    }
}
