<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Show the settings form
    public function settings(Request $request,$id = null)
    {
        if ($request->isMethod('post')){
            // dd($request);
            $settings =  Setting::find($id);
            $settings->update([
                'multiplier_default'=> $request->multiplier_default,
                'multiplier_cost'=> $request->multiplier_cost,
                'tcg_low'=> $request->tcg_low,
                'tcg_mid'=> $request->tcg_mid,
                'tcg_high'=> $request->tcg_high,
                'sold_price'=> $request->sold_price,
                'estimated_card_cost'=> $request->estimated_card_cost,
                'ship_cost'=> $request->ship_cost,
                'ship_price'=> $request->ship_price,

            ]);
            return redirect()->back();
        }
       

        $settings = Setting::with('paymentMethods','paymentStatus','currency')->first()->toArray(); 
        $settings['method'] =  PaymentMethod::get()->toArray();
        $settings['status'] =  PaymentStatus::get()->toArray();
        $settings['currency_option'] =  Currency::get(['id', 'currency_name', 'symbol'])->toArray();
        // dd($settings);
        return view('settings')->with(compact('settings'));
    }

    public function save(Request $request)
    {
        // Save
        Setting::create([
            'payment_methods' => $request->payment_methods,
            'payment_status' => $request->payment_status,
            'multiplier_default' => $request->multiplier_default,
            'multiplier_cost' => $request->multiplier_cost,
            'tcg_status' => $request->tcg_status,
            'sold_price' => $request->sold_price,
            'estimated_card_cost' => $request->estimated_card_cost,
            'shipment_cost' => $request->shipment_cost,
            'shipment_price' => $request->shipment_price,

            // dd($settings);

            // $settings = Settings::firstOrFail();

            // $settings->fill($request->all());

            // $settings->save();

        ]);

        return redirect()->back()->with('success', 'Saved successfully.');
    }
}