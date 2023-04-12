<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventories';

    protected $primaryKey = 'id';

    protected $fillable = [];

    //Store Excel file into Database
    public function storeCsv()
    {

        $count = Counter::all();

        foreach ($count as $data) {
            $response = file_get_contents('https://api.scryfall.com/cards/tcgplayer/' . $data->product_id);
            $card = json_decode($response, true);
            // $data = str_replace('_', ' ', $data);

            $product = new Inventory();
            foreach ($card as $key => $value) {
                //$key = str_replace('_', ' ', $key);
                //$key = ucwords($key);

                if (!Schema::hasColumn('inventories', $key)) {
                    Schema::table('inventories', function ($table) use ($key) {
                        $table->longText($key)->nullable();
                    });
                }
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $product->setAttribute($key, $value);
            }
            $product->save();
        }
        return redirect('inventory');
    }
}