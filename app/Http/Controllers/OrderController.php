<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::get();
        // dd($orders);
        return view('orders')->with(compact('orders'));
    }
}
