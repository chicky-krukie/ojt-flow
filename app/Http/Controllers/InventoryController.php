<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\CsvOutput;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Imports\CounterImport;
use App\Imports\InventoryImport;
use Illuminate\Support\Facades\DB;
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

    //Sold
    public function update(Request $request, $id)
    {
        $csv = CsvOutput::find($id);
        $input = $request->all();
        $csv->fill($input)->save();

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