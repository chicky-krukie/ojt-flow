<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('object')->nullable();
            $table->text('object_id')->nullable();
            $table->text('oracle_id')->nullable();
            $table->text('multiverse_ids')->nullable();
            $table->integer('mtgo_id')->nullable();
            $table->unsignedBigInteger('tcgplayer_id')->unique();
            $table->integer('cardmarket_id')->nullable();
            $table->text('name')->nullable();
            $table->text('lang')->nullable();
            $table->text('released_at')->nullable();
            $table->text('uri')->nullable();
            $table->text('scryfall_uri')->nullable();
            $table->text('layout')->nullable();
            $table->boolean('highres_image')->nullable();
            $table->text('image_status')->nullable();
            $table->text('art_crop')->nullable();
            $table->text('normal')->nullable();
            $table->text('mana_cost')->nullable();
            $table->text('cmc')->nullable();
            $table->text('type_line')->nullable();
            $table->text('oracle_text')->nullable();
            $table->text('power')->nullable();
            $table->text('toughness')->nullable();
            $table->text('colors')->nullable();
            $table->text('color_identity')->nullable();
            $table->text('keywords')->nullable();
            $table->json('legalities')->nullable();
            $table->text('games')->nullable();
            $table->text('reserved')->nullable();
            $table->boolean('foil')->nullable();
            $table->boolean('nonfoil')->nullable();
            $table->text('finishes')->nullable();
            $table->boolean('oversized')->nullable();
            $table->boolean('promo')->nullable();
            $table->boolean('reprint')->nullable();
            $table->boolean('variation')->nullable();
            $table->text('set_id')->nullable();
            $table->text('set')->nullable();
            $table->text('set_name')->nullable();
            $table->text('set_type')->nullable();
            $table->text('set_uri')->nullable();
            $table->text('set_search_uri')->nullable();
            $table->text('scryfall_set_uri')->nullable();
            $table->text('rulings_uri')->nullable();
            $table->text('prints_search_uri')->nullable();
            $table->text('collector_number')->nullable();
            $table->boolean('digital')->nullable();
            $table->text('rarity')->nullable();
            $table->text('card_back_id')->nullable();
            $table->text('artist')->nullable();
            $table->text('artist_ids')->nullable();
            $table->text('illustration_id')->nullable();
            $table->text('border_color')->nullable();
            $table->text('frame')->nullable();
            $table->text('frame_effects')->nullable();
            $table->boolean('full_art')->nullable();
            $table->boolean('textless')->nullable();
            $table->boolean('booster')->nullable();
            $table->boolean('story_spotlight')->nullable();
            $table->text('promo_types')->nullable();
            $table->integer('edhrec_rank')->nullable();
            $table->integer('penny_rank')->nullable();
            $table->json('preview')->nullable();
            $table->json('prices')->nullable();
            $table->json('related_uris')->nullable();
            $table->json('purchase_uris')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
