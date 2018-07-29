<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('van_id')->index()->unsigned();
            $table->integer('product_id')->index()->unsigned();
            $table->integer('quantity');
            $table->timestamps();


            $table->foreign('van_id')->references('id')->on('vans');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('van_details');
    }
}
