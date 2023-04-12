<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->string('product_id');
            $table->string('price_each');
            $table->string('printing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('counter');
    }
};