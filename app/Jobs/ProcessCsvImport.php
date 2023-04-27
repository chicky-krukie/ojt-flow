<?php

namespace App\Jobs;

use App\Models\DataUpload;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
        ini_set('max_execution_time', 1000);

        $dataIds = collect($this->data)->pluck('product_id')->toArray();
        $batches = collect($this->data)->chunk(10);

        // Initialize counter and start time
        $totalCount = count($dataIds);
        $processedCount = 0;
        $startTime = now();

    
        foreach ($batches as $batch) {
            $dataIds = $batch->pluck('product_id')->toArray();

            $apiData = collect($dataIds)->map(function ($id) {
                $response = Http::get('https://api.scryfall.com/cards/tcgplayer/' . $id);
                $data = $response->json();

                return [
                    'object' => isset($data['object']) ? $data['object'] : null,
                    'object_id' => isset($data['id']) ? $data['id'] : null,
                    'oracle_id' => isset($data['oracle_id']) ? $data['oracle_id'] : null,
                    'multiverse_ids' => !empty($data['multiverse_ids']) ? implode(',', $data['multiverse_ids']) : null,
                    'mtgo_id' => isset($data['mtgo_id']) ? $data['mtgo_id'] : null,
                    'tcgplayer_id' => isset($data['tcgplayer_id']) ? $data['tcgplayer_id'] : $data['tcgplayer_etched_id'],
                    'cardmarket_id' => isset($data['cardmarket_id']) ? $data['cardmarket_id'] : null,
                    'name' => isset($data['name']) ? $data['name'] : null,
                    'lang' => isset($data['lang']) ? $data['lang'] : null,
                    'released_at' => isset($data['released_at']) ? $data['released_at'] : null,
                    'uri' => isset($data['uri']) ? $data['uri'] : null,
                    'scryfall_uri' => isset($data['scryfall_uri']) ? $data['scryfall_uri'] : null,
                    'layout' => isset($data['layout']) ? $data['layout'] : null,
                    'highres_image' => isset($data['highres_image']) ? $data['highres_image'] : false,
                    'image_status' => isset($data['image_status']) ? $data['image_status'] : null,
                    'art_crop' => isset($data['image_uris']) ?  $data['image_uris']['art_crop'] : null,
                    'normal' => isset($data['image_uris']) ? $data['image_uris']['normal'] : null,
                    'mana_cost' => isset($data['mana_cost']) ? $data['mana_cost'] : null,
                    'cmc' => isset($data['cmc']) ? $data['cmc'] : null,
                    'type_line' => isset($data['type_line']) ? $data['type_line'] : null,
                    'oracle_text' => isset($data['oracle_text']) ? $data['oracle_text'] : null,
                    'power' => isset($data['power']) ? $data['power'] : null,
                    'toughness' => isset($data['toughness']) ? $data['toughness'] : null,
                    'colors' => !empty($data['colors']) ?  implode(',', $data['colors']) : null,
                    'color_identity' => !empty($data['color_identity']) ? implode(',', $data['color_identity']) : 'land',
                    'keywords' => !empty($data['keywords']) ? implode(',', $data['keywords']) : null,
                    'legalities' => isset($data['legalities']) ? json_encode($data['legalities']) : null,
                    'games' => !empty($data['games']) ?  implode(',', $data['games']) : null,
                    'reserved' => isset($data['reserved']) ? $data['reserved'] : null,
                    'foil' => isset($data['foil']) ? $data['foil'] : false,
                    'nonfoil' => isset($data['nonfoil']) ? $data['nonfoil'] : false,
                    'finishes' => !empty($data['finishes']) ?  implode(',', $data['finishes']) : null,
                    'oversized' => isset($data['oversized']) ? $data['oversized'] : false,
                    'promo' => isset($data['promo']) ? $data['promo'] : false,
                    'reprint' => isset($data['reprint']) ? $data['reprint'] : false,
                    'variation' => isset($data['variation']) ? $data['variation'] : false,
                    'set_id' => isset($data['set_id']) ? $data['set_id'] : null,
                    'set' => isset($data['set']) ? $data['set'] : null,
                    'set_name' => isset($data['set_name']) ? $data['set_name'] : null,
                    'set_type' => isset($data['set_type']) ? $data['set_type'] : null,
                    'set_uri' => isset($data['set_uri']) ? $data['set_uri'] : null,
                    'set_search_uri' => isset($data['set_search_uri']) ? $data['set_search_uri'] : null,
                    'scryfall_set_uri' => isset($data['scryfall_set_uri']) ? $data['scryfall_set_uri'] : null,
                    'rulings_uri' => isset($data['rulings_uri']) ? $data['rulings_uri'] : null,
                    'prints_search_uri' => isset($data['prints_search_uri']) ? $data['prints_search_uri'] : null,
                    'collector_number' => isset($data['collector_number']) ? $data['collector_number'] : null,
                    'digital' => isset($data['digital']) ? $data['digital'] : false,
                    'rarity' => isset($data['rarity']) ? $data['rarity'] : null,
                    'card_back_id' => isset($data['card_back_id']) ? $data['card_back_id'] : null,
                    'artist' => isset($data['artist']) ? $data['artist'] : null,
                    'artist_ids' => !empty($data['artist_ids']) ?  implode(',', $data['artist_ids']) : null,
                    'illustration_id' => isset($data['illustration_id']) ? $data['illustration_id'] : null,
                    'border_color' => isset($data['border_color']) ? $data['border_color'] : null,
                    'frame' => isset($data['frame']) ? $data['frame'] : null,
                    'frame_effects' => isset($data['frame_effects']) ? implode(',', $data['frame_effects']) : 'normal',
                    'full_art' => isset($data['full_art']) ? $data['full_art'] : false,
                    'textless' => isset($data['textless']) ? $data['textless'] : false,
                    'booster' => isset($data['booster']) ? $data['booster'] : false,
                    'story_spotlight' => isset($data['story_spotlight']) ? $data['story_spotlight'] : false,
                    'promo_types' => !empty($data['promo_types']) ?  implode(',', $data['promo_types']) : null,
                    'edhrec_rank' => isset($data['edhrec_rank']) ? $data['edhrec_rank'] : null,
                    'penny_rank' => isset($data['penny_rank']) ? $data['penny_rank'] : null,
                    'preview' => isset($data['preview']) ? json_encode($data['preview']) : null,
                    'prices' => isset($data['prices']) ? json_encode($data['prices']) : null,
                    'related_uris' => isset($data['related_uris']) ? json_encode($data['related_uris']) : null,
                    'purchase_uris' => isset($data['purchase_uris']) ? json_encode($data['purchase_uris']) : null,


                ];
           
            })->toArray();

           $newBatch =  collect($batch)->map(function ($item) {
                $item['price_each'] = str_replace('$', '', $item['price_each']);
                $item['quantity'] = (int)$item['quantity'];
                return $item;
            })->toArray();

            DataUpload::upsert($newBatch, ['product_id','printing'], ['product_id','quantity' => DB::raw('quantity + VALUES(quantity)'), 'price_each', 'printing'], );
            Product::upsert($apiData, ['tcgplayer_id','foil'], [
                'object',
                'object_id',
                'oracle_id',
                'multiverse_ids',
                'mtgo_id',
                'tcgplayer_id',
                'cardmarket_id',
                'name',
                'lang',
                'released_at',
                'uri',
                'scryfall_uri',
                'layout',
                'highres_image',
                'image_status',
                'art_crop',
                'normal',
                'mana_cost',
                'cmc',
                'type_line',
                'oracle_text',
                'power',
                'toughness',
                'colors',
                'color_identity',
                'keywords',
                'legalities',
                'games',
                'reserved',
                'foil',
                'nonfoil',
                'finishes',
                'oversized',
                'promo',
                'reprint',
                'variation',
                'set_id',
                'set',
                'set_type',
                'set_uri',
                'set_search_uri',
                'scryfall_set_uri',
                'rulings_uri',
                'prints_search_uri',
                'collector_number',
                'digital',
                'rarity',
                'card_back_id',
                'artist',
                'artist_ids',
                'illustration_id',
                'border_color',
                'frame',
                'frame_effects',
                'full_art',
                'textless',
                'booster',
                'story_spotlight',
                'promo_types',
                'edhrec_rank',
                'penny_rank',
                'preview',
                'prices',
                'related_uris',
                'purchase_uris',
            ]);

            // Increment counter
            $processedCount += $batch->count();

            // Update progress in cache
            Cache::put('csv_import_progress', [
                'total' => $totalCount,
                'processed' => $processedCount,

            ]);
        }

        // Calculate execution time
        $hours = gmdate('H', now()->diffInSeconds($startTime));
        $minutes = gmdate('i', now()->diffInSeconds($startTime));
        $seconds = gmdate('s', now()->diffInSeconds($startTime));

        $formattedDuration = $hours . ':' . $minutes . ':' . $seconds;

        Cache::put('totalTime', $formattedDuration);
    }
}