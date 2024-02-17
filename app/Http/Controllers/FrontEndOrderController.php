<?php

namespace App\Http\Controllers;

use App\Mail\OrderSubmitted;
use App\Mail\OrderSubmittedAdmin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontEndOrderController extends Controller
{
    public function saveOrder(Request $request)
    {

        $data['address'] = $request->input('address');
        $data['city'] = $request->input('city');
        $data['countryCode'] = $request->input('countryCode');
        $data['email'] = $request->input('email');
        $data['firstName'] = $request->input('firstName');
        $data['lastName'] = $request->filled('lastName') ? $request->input('lastName') : 'default';;
        $data['phone'] = $request->input('phone');
        $data['postalCode'] = $request->input('postalCode');
        $data['time'] = $request->input('time');
        $data['zone'] = $request->input('zone');


        $data['products'] = $request->input('products');
        $data['status'] = 'ordered';
        $data['description'] = 'ordered';
        $data['notes'] = 'ordered';
        $data['other'] = 'ordered';

        $order = Order::create($data);

        $orderSubmittedEmail = new OrderSubmitted($order);
        $orderSubmittedEmailAdmin = new OrderSubmittedAdmin($order);

        // Use the Mail facade to send the email
        Mail::to($request->input('email'))->send($orderSubmittedEmail);
        Mail::to('info@ozyarabia.com')->send($orderSubmittedEmailAdmin);
        return response()->json(['status' => 'success']);
    }
}
