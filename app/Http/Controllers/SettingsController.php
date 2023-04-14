<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    // Show the settings form
    public function index()
    {
        $settings = Settings::firstOrFail();
        return view('settings.index', compact('settings'));
    }

    public function save(Request $request)
    {
        // Save
        Settings::create([
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
