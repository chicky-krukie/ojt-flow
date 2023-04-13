<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $settings = Setting::with('paymentMethods','paymentStatus','tcg')->get()->first()->toArray();
        // dd($settings);
        return view('home')->with(compact('settings'));
    }
}
