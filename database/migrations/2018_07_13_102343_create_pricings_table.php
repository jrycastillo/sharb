<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('unit_id')->index()->unsigned();
            $table->integer('loading_id')->index()->unsigned();
            $table->double('price');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('loading_id')->references('id')->on('loadings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricings');
    }
}
