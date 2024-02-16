<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Products;
use App\Models\ProductSubCategory;
use App\Models\Services;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sub_url = null;
        $url = null;
        $services = Services::where('is_home', 1)->orderBy('id', 'desc')->get();
        $testimonials = Testimonial::where('is_home', 1)->orderBy('id', 'desc')->get();
        $products = Products::where('is_featured', 1)->orderBy('id', 'desc')->get();
        $productsValue = Products::where('is_valuable', 1)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::all();
        $categoriesMain = Menu::orderBy('order')->get();
        return view('front-end.home.view', compact('services', 'categories', 'categoriesMain', 'url', 'sub_url', 'products', 'productsValue', 'testimonials'));
    }

    public function aboutUs()
    {
        $sub_url = null;
        $url = null;
        $services = Services::orderByDesc('created_at')->take(4)->get();
        $products = Products::orderByDesc('created_at')->take(12)->get();
        $testimonials = Testimonial::where('created_at')->take(6)->get();

        return view('front-end.about-us.view', compact('services', 'products', 'testimonials'));
    }

    public function contactUs()
    {
        $products = Products::orderByDesc('created_at')->take(12)->get();
        return view('front-end.contact-us.view', compact('products'));
    }
}
