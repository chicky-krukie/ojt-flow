<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Counter;
use App\Models\Setting;
use App\Models\CsvOutput;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Imports\CounterImport;
use Illuminate\Support\Carbon;
use App\Imports\InventoryImport;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{

    //Inventory Table Function
    public function inventoryTable()
    {
        $settings = Setting::with('paymentMethods', 'paymentStatus', 'tcg')->get()->first()->toArray();
        // dd($settings);
        // import
        $product = Inventory::all();
        $csv = CsvOutput::all();
        $order = Order::all();

        return view('inventory', [
            'inventories' => $product, 'csv_outputs' => $csv,
            'orders' => $order, 'settings' => $settings,
        ]);
    }

    //Import CSV
    public function importCsv(Request $request)
    {
        // $validatedData = $request->validate([
        //     'file' => 'required',
        // ], [
        //     'file.required' => 'this file required'
        // ]);

        // $delete = Counter::all();
        // foreach ($delete as $del) {
        //     $del->delete();
        // }

        // Excel::import(new InventoryImport, $request->file('file'));
        // Excel::import(new CounterImport, $request->file('file'));
        // $inventory = app(Inventory::class);
        // return $inventory->storeCsv();

        $validatedData = $request->validate([
            'file' => 'required',
        ], [
            'file.required' => 'This file is required',
        ]);

        $delete = Counter::all();
        foreach ($delete as $del) {
            $del->delete();
        }

        Excel::import(new InventoryImport, $request->file('file'));
        Excel::import(new CounterImport, $request->file('file'));

        // Calculate the total values and save them to the database
        $csv_outputs = CsvOutput::all();
        foreach ($csv_outputs as $csv_output) {
            $total = floatval($csv_output->quantity) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_output->price_each));
            $csv_output->total = $total;
            $csv_output->save();
        }

        $inventory = app(Inventory::class);
        return $inventory->storeCsv();
    }

    public function update(Request $request, $id)
    {
        
        //SOLD POP UP STORED IN DATA TABLES OF 'Order'

        $csv = CsvOutput::with('inventory')->find($id)->toArray();
        // dd($csv);
        // $input = $request->all();
        // $csv->fill($input)->save;
        // $csv = Inventory::where('uid', $id)->get();
        // dd($csv);
        

        $orders = new Order;
        $orders->sold_date = Carbon::now()->format('Y/m/d');
        $orders->sold_to = $request->name;
        $orders->card_name = $csv['inventory']['name'];
        $orders->set = $csv['inventory']['set'];
        $orders->finish = $csv['printing'];
        $orders->tcg_mid = $csv['price_each'];
        $orders->qty = $request->quantity;
        $orders->sold_price = $request->sold;
        $orders->ship_cost = $request->ship_cost;
        $orders->payment_status = $request->payment_status;
        $orders->payment_method = $request->payment_methods;
        $orders->tcgplacer_id = $csv['product_id'];
        $orders->ship_price = $request->ship_price;
        // $orders->tracking_number = $request->tracking_number;
        $orders->multiplier = $request->multiplier;
        $orders->multiplier_price = $request->multiplied_price;
        $orders->note = $request->note;
        $orders->save();
      
        return redirect()->route('inventory')->with('sucess', 'Product updated');
    }

    public function delete($id, $uid)
    {
        $csv = CsvOutput::find($id);
        // dd($csv->id);
        $csv->delete();

        // Delete a row from the Inventory table
        $json = Inventory::where('uid', $uid)->firstOrFail();
        // dd($json->uid);
        $json->delete();

        return redirect()->route('inventory')->with('sucess', 'Product deleted');
    }
}
