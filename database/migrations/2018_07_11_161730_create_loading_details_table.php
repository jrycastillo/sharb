<?php

use App\LoadingDetail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoadingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loading_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loading_id')->index()->unsigned();
            $table->integer('supplier_id')->index()->unsigned()->nullable($value = true);
            $table->string('BL_no');
            $table->string('productionWeek')->nullable($value = true);
            $table->string('shipmentWeek');
            $table->string('rev')->default(LoadingDetail::NEW);
            $table->integer('rev_no')->default(1);
            $table->date('ETD');
            $table->date('ETA');
            $table->string('voyage_no');
            $table->string('status')->default(LoadingDetail::BOOKING);
            $table->string('year');
            $table->string('vessel');
            $table->integer('portOfDischarge_id')->index()->unsigned();
            $table->integer('portOfLoading_id')->index()->unsigned();
            $table->integer('exporter_id')->index()->unsigned();
            $table->integer('carrier_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('portOfDischarge_id')->references('id')->on('port_of_discharges');
            $table->foreign('portOfLoading_id')->references('id')->on('port_of_loadings');
            $table->foreign('exporter_id')->references('id')->on('exporters');
            $table->foreign('carrier_id')->references('id')->on('carriers');
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
        Schema::dropIfExists('loading_details');
    }
}
