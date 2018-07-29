<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadingPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading_pricing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pricing_id')->index()->unsigned();
            $table->integer('loading_id')->index()->unsigned();

            $table->foreign('pricing_id')->references('id')->on('pricings');
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
        Schema::dropIfExists('loading_pricing');
    }
}
