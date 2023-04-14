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
            $table->date('sold_date');
            $table->string('sold_to');
            $table->string('card_name');
            $table->string('set');
            $table->string('finish');
            $table->string('tcg_mid');
            $table->string('qty');
            $table->string('sold_price');
            $table->string('ship_cost');
            $table->string('payment_status');
            $table->string('payment_method');
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
