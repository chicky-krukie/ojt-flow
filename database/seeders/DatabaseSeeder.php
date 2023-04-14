<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $settings = Setting::create([
            'multiplier_default' => '50',
            'multiplier_cost' => '50',
        ]);

        $status = ['Paid','Unpaid','Reserve'];
        foreach($status as $stat)
        {
            $settings->paymentStatus()->create([
                'status'=> $stat,
                'settings_id' => $settings->id,
            ]);
        }

        $methods = ['Gcash','Unpaid','Reserve'];
        foreach($methods as $method)
        {
            $settings->paymentMethods()->create([
                'method'=> $method,
                'settings_id' => $settings->id,
            ]);
        }
[];
        
       
            $settings->currency()->create([
                'tcg_low'=> '$',
                'tcg_mid'=> '$',
                'tcg_high'=> '$',
                'sold_price'=> 'Php',
                'ship_cost'=> 'Php',
                'ship_price'=> 'Php',
                'estimated_card_cost'=> 'Php',
                'settings_id'=> $settings->id,
            ]);
        



    }
}
