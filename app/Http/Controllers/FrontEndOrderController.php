<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class FrontEndOrderController extends Controller
{
    public function saveOrder(Request $request)
    {

        $data['address'] = $request->input('address');
        $data['city'] = $request->input('city');
        $data['countryCode'] = $request->input('countryCode');
        $data['email'] = $request->input('email');
        $data['firstName'] = $request->input('firstName');
        $data['lastName'] = $request->input('lastName');
        $data['phone'] = $request->input('phone');
        $data['postalCode'] = $request->input('postalCode');
        $data['time'] = $request->input('time');
        $data['zone'] = $request->input('zone');


        $data['products'] = $request->input('products');
        $data['status'] = 'ordered';
        $data['description'] = 'ordered';
        $data['notes'] = 'ordered';
        $data['other'] = 'ordered';

        Order::create($data);

        return response()->json(['status' => 'success']);
    }
}
