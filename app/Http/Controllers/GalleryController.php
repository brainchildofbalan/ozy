<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // $posts = Post::all();

        $url =  null;

        $sub_url = null;
        $mainCategory = ProductCategory::all();
        // $categoriesMain = ProductCategory::all();
        return view('front-end.gallery.view', compact('mainCategory', 'sub_url', 'url'));
    }


    public function category($url)
    {
        // $posts = Post::all();
        $sub_url = null;

        $mainCategory = ProductCategory::all();
        $get_category_id = ProductCategory::where('url', $url)->first();
        $products = Products::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::where('relative_category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ProductCategory::all();
        return view('front-end.gallery.view', compact('products', 'categories', 'sub_url', 'url', 'mainCategory'));
    }


    public function SubCategory($url, $sub_url)
    {
        // $posts = Post::all();

        $mainCategory = ProductCategory::all();
        $get_category_id = ProductCategory::where('url', $url)->first();
        $get_sub_category_id = ProductSubCategory::where('url', $sub_url)->first();
        $products = Products::where('category_id', $get_category_id->category_id . ',' . $get_category_id->name)->where('sub_category_id', $get_sub_category_id->category_id . ',' . $get_sub_category_id->name)->orderBy('id', 'desc')->get();
        $categories = ProductSubCategory::where('relative_category_id', $get_category_id->category_id . ',' . $get_category_id->name)->orderBy('id', 'asc')->get();
        // $categoriesMain = ProductCategory::all();
        return view('front-end.gallery.view', compact('products', 'categories', 'sub_url', 'url', 'mainCategory'));
    }
}
