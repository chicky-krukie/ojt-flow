<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\DataUploadImport;
use App\Imports\ProductImport;
use App\Models\DataUpload;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function home()
    {
        $inventories = DataUpload::with('product')->get()->toArray();
        // echo '<pre>'; print_r($inventories); die;

        return view('home')->with(compact('inventories'));
    }

    public function importProductFromExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv',
        ], [
            'file.required' => 'This field is required',
            'file.mimes' => 'Invalid csv file',
        ]);

        // Read data from Excel file
        $path = $request->file('file')->getRealPath();
        $data = Excel::toArray(new DataUploadImport, $path)[0];



        $dataIds = collect($data)->pluck('product_id')->toArray();


        $apiData = collect($dataIds)->map(function ($id) {
            $response = Http::get('https://api.scryfall.com/cards/tcgplayer/' . $id);
            $data = $response->json();

            return [
                'tcgplayer_id' => isset($data['tcgplayer_id']) ? $data['tcgplayer_id'] : $data['tcgplayer_etched_id'],
                'name' => $data['name'],
                'normal' => $data['image_uris']['normal'],
                'art_crop' => $data['image_uris']['art_crop'],
                'type_line' => $data['type_line'],
                'color_identity' => empty($data['color_identity']) ? 'land' : implode(',', $data['color_identity']),
                'finishes' => implode(',', $data['finishes']),
                'set_name' => $data['set_name'],
                'rarity' => $data['rarity'],
                'frame_effects' => isset($data['frame_effects']) ? implode(',', $data['frame_effects']) : 'normal',
            ];
        })->toArray();


        // echo '<pre>';
        // print_r($apiData);
        // die;



        DataUpload::upsert($data, ['product_id'], ['product_id', 'quantity', 'price_each', 'printing',]);
        Product::upsert($apiData, ['tcgplayer_id'], ['tcgplayer_id', 'name', 'set_name', 'normal', 'art_crop', 'type_line', 'color_identity', 'finishes', 'rarity', 'frame_effects',]);



        return redirect()->back();
    }
}
