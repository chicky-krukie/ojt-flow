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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('sold_date')->nullable();
            $table->string('sold_to')->nullable();
            $table->string('card_name')->nullable();
            $table->string('set')->nullable();
            $table->string('finish')->nullable();
            $table->string('tcg_mid')->nullable();
            $table->string('qty')->nullable();
            $table->string('sold_price')->nullable();
            $table->string('ship_cost')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('note')->nullable();
            $table->string('ship_price')->nullable();
            $table->string('tcgplacer_id')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('multiplier')->nullable();
            $table->string('multiplier_price')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
