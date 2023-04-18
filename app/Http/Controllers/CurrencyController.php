<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function addCurrency(Request $request){
        Currency::create([
            'currency_name' => $request->currency_name,
            'symbol' =>$request->symbol,
        ]);

        return redirect()->back();
    }

    public function addMethod(Request $request){
        PaymentMethod::create([
            'method' => $request->payment_method,
        ]);

        return redirect()->back();
    }
}
