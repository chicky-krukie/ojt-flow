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
            $table->text('name')->nullable();
            $table->text('set_name')->nullable();
            $table->text('color_identity')->nullable();
            $table->text('type_line')->nullable();
            $table->text('frame_effects')->nullable();
            $table->text('finishes')->nullable();
            $table->text('rarity')->nullable();
            $table->text('art_crop')->nullable();
            $table->text('normal')->nullable();
            $table->unsignedBigInteger('tcgplayer_id')->unique();
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
