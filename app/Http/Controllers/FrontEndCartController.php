<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class FrontEndCartController extends Controller
{
    public function index()
    {
        return view('front-end.cart.view');
    }
}