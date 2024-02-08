<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Services;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $req = $request->input('search-products');

        $products = Products::where('name', 'like', "%$req%")
            ->orWhere('description', 'like', "%$req%")->get();;

        // Search users by name or email
        $services = Services::where('name', 'like', "%$req%")
            ->orWhere('description', 'like', "%$req%")->get();;

        // Combine search results from both tables
        // $results = $products->union($users)->get();
        return response()->json(['products' => $products, 'service' => $services]);
    }
}
