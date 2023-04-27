<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Setting;
use App\Models\User;
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
            'currency_id' => 1,
            'payment_method_id' => 1,
            'payment_status_id' => 1,
            'tcg_low' => 1,
            'tcg_mid' => 1,
            'tcg_high' => 1,
            'sold_price' => 2,
            'ship_cost' => 2,
            'ship_price' => 2,
            'estimated_card_cost' => 2,

        ]);

        $status = ['Paid','Unpaid','Reserve'];
        foreach($status as $stat)
        {
            PaymentStatus::create([
                'status'=> $stat,
            ]);
        }

        $methods = ['Gcash','Cash','Bank'];
        foreach($methods as $method)
        {
            PaymentMethod::create([
                'method'=> $method,
            ]);
        }


        $currencies = ['Dollar' => '$', 'Peso' => '₱'];
        foreach($currencies as $name => $symbol)
        {
            Currency::create([
                'currency_name' => $name,
                'symbol' => $symbol,
            ]);
        }

        
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@email.com',
               'role'=> 0,
               'password'=> bcrypt('admin123'),
            ],
            [
               'name'=>'Staff',
               'email'=>'staff@email.com',
               'role'=> 1,
               'password'=> bcrypt('staff123'),
            ],
            
        ];


        foreach ($users as $key => $user) 
        {
            User::create($user);
        }



    }
}
