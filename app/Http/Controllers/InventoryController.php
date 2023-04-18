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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{

    //Inventory Table Function
    public function inventoryTable()
    {
        $settings = Setting::with('paymentMethods', 'paymentStatus', 'currency')->get()->first()->toArray();
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
            'file' => 'required|mimes:csv,text',
        ], [
            'file.required' => ['Required CSV File', 'Please double-check that you are submitting a CSV (Comma Separated Values) file before clicking submit. Any other file formats will not be accepted.'],
            'file.mimes' => ['The file must be a CSV', 'Please ensure that the file you upload is in CSV (Comma Separated Values) format. Only CSV files are accepted.'],
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

    //Sort Quantity Function
    public function sortQuantity(Request $request)
    {
        $condition = $request->input('condition');
        $value = $request->input('value');

        $query = DB::table('csv_outputs')->orderBy('quantity');

        switch ($condition) {
            case '=':
                $query->where('quantity', $value);
                break;
            case '<':
                $query->where('quantity', '<', $value);
                break;
            case '<=':
                $query->where('quantity', '<=', $value);
                break;
            case '>':
                $query->where('quantity', '>', $value);
                break;
            case '>=':
                $query->where('quantity', '>=', $value);
                break;
            default:
                // handle invalid condition
                break;
        }
        $product = Inventory::all();
        $csv = CsvOutput::all();

        return view('inventory', [
            'inventories' => $product, 'csv_outputs' => $csv
        ])->with('condition', $condition)->with('value', $value);
    }

    public function up(Request $request, $id)
    {
        $csvOutput = CsvOutput::find($id);

        if ($csvOutput) {
            $csvOutput->increment('quantity', 1);
        }
    
        return redirect()->back();
    }

    public function down(Request $request, $id)
    {
        $csvOutput = CsvOutput::find($id);

        if ($csvOutput) {
            if($csvOutput->quantity <= 0){
                $csvOutput->quantity = 0;
            }else{
                $csvOutput->decrement('quantity', 1);
            }    
        }
    
        return redirect()->back();
    }

    //Sold
    public function update(Request $request, $id)
    {

        //SOLD POP UP STORED IN DATA TABLES OF 'Order'

        return redirect()->route('inventory')->with('success', 'Product updated');
    }

    //Delete Row
    public function delete($id, $uid)
    {
        $csv = CsvOutput::find($id);
        $csv->delete();

        // Delete a row from the Inventory table
        $json = Inventory::where('uid', $uid)->firstOrFail();
        $json->delete();

        return redirect()->route('inventory')->with('sucess', 'Product deleted');
    }

    //Inline Edit (not working)
    public function updatePrice(Request $request)
    {
        if ($request->ajax()) {
            CsvOutput::find($request->pk)->update([
                $request->name => $request->value
            ]);
            return response()->json(['success' => true]);
        }
    }
}