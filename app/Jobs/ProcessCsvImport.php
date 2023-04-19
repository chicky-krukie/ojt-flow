<?php

namespace App\Jobs;

use App\Models\DataUpload;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ProcessCsvImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        ini_set('max_execution_time', 300);
        $dataIds = collect($this->data)->pluck('product_id')->toArray();
        $batches = collect($this->data)->chunk(10);

        foreach ($batches as $batch) {
            $dataIds = $batch->pluck('product_id')->toArray();

            $apiData = collect($dataIds)->map(function ($id) {
                $response = Http::get('https://api.scryfall.com/cards/tcgplayer/' . $id);
                $data = $response->json();

                return [
                    'tcgplayer_id' => isset($data['tcgplayer_id']) ? $data['tcgplayer_id'] : $data['tcgplayer_etched_id'],
                    'name' => $data['name'],
                    'normal' => isset($data['image_uris']) ? $data['image_uris']['normal'] : null,
                    'art_crop' => isset($data['image_uris']) ?  $data['image_uris']['art_crop'] : null,
                    'type_line' => $data['type_line'],
                    'color_identity' => empty($data['color_identity']) ? 'land' : implode(',', $data['color_identity']),
                    'finishes' => implode(',', $data['finishes']),
                    'set_name' => $data['set_name'],
                    'rarity' => $data['rarity'],
                    'frame_effects' => isset($data['frame_effects']) ? implode(',', $data['frame_effects']) : 'normal',
                ];
            })->toArray();

            DataUpload::upsert($batch->toArray(), ['product_id'], ['product_id', 'quantity', 'price_each', 'printing',]);
            Product::upsert($apiData, ['tcgplayer_id'], ['tcgplayer_id', 'name', 'set_name', 'normal', 'art_crop', 'type_line', 'color_identity', 'finishes', 'rarity', 'frame_effects']);
        }
    }
}
