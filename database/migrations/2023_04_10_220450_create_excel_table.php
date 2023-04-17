<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::create('csv_outputs', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('product_id');
            $table->string('price_each');
            $table->string('printing');
            $table->string('total')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('csv_outputs');
    }
};