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
            $table->string('payment_methods');
            $table->string('payment_status');
            $table->string('multiplier_default');
            $table->string('multiplier_cost');
            $table->string('tcg_status');
            $table->string('sold_price');
            $table->string('estimated_card_cost');
            $table->string('shipment_cost');
            $table->string('shipment_price');
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
