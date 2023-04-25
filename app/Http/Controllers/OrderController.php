<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\DataUpload;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $settings = Setting::with('paymentMethods', 'paymentStatus', 'currency')->first()->toArray();
        $settings['method'] =  PaymentMethod::get()->toArray();
        $settings['status'] =  PaymentStatus::get()->toArray();
        $settings['currency_option'] =  Currency::get(['id', 'currency_name', 'symbol'])->toArray();

        $orders = Order::get();
        // dd($orders->toArray());
        return view('orders', [
            'orders' => $orders, 'settings' => $settings,
        ]);

        // return view('orders')->with(compact('orders'));
    }

    public function returnOrder($id, $tcgplacer_id)
    {

        $return_order = Order::with('product')->where('tcgplacer_id', (int)$tcgplacer_id)->get()->first()->toArray();


        DataUpload::where('product_id', $tcgplacer_id)->update([
            'quantity' =>  (int)($return_order['qty']) + (int)($return_order['product']['quantity'])
        ]);

        Order::where('id', $id)->delete();

        return redirect()->route('sortQuantity')->with('success', 'Order Deleted');
    }

    public function editOrder(Request $request, $id)
    {
        $order = Order::find($id)->update(['payment_status' => $request->payment_status]);

        return redirect()->back();
    }

    public function deleteSelectOrder(Request $request)
    {

        $ids = $request->ids;
        Order::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => "Order Deleted."]);
    }
}
