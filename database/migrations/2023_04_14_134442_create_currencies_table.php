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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('tcg_low');
            $table->string('tcg_mid');
            $table->string('tcg_high');
            $table->string('sold_price');
            $table->string('ship_cost');
            $table->string('ship_price');
            $table->string('estimated_card_cost');
            $table->bigInteger('settings_id');
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
        Schema::dropIfExists('currencies');
    }
};
