<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\CsvOutput;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Imports\CounterImport;
use App\Imports\InventoryImport;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{

    //Inventory Table Function
    public function inventoryTable()
    {
        $product = Inventory::all();
        $csv = CsvOutput::all();
        return view('inventory', [
            'inventories' => $product, 'csv_outputs' => $csv
        ]);
    }

    //Import CSV
    public function importCsv(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ],[
            'file.required' => 'this file required'
        ]);

        $delete = Counter::all();
        foreach ($delete as $del) {
            $del->delete();
        }
        
        Excel::import(new InventoryImport, $request->file('file'));
        Excel::import(new CounterImport, $request->file('file'));
        $inventory = app(Inventory::class);
        return $inventory->storeCsv();
    }
}