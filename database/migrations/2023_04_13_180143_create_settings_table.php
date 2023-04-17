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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('multiplier_default');
            $table->string('multiplier_cost');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('tcg_low');
            $table->unsignedBigInteger('tcg_mid');
            $table->unsignedBigInteger('tcg_high');
            $table->unsignedBigInteger('sold_price');
            $table->unsignedBigInteger('ship_cost');
            $table->unsignedBigInteger('ship_price');
            $table->unsignedBigInteger('estimated_card_cost');
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
        Schema::dropIfExists('settings');
    }
};
