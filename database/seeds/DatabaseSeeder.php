<?php

use App\Carrier;
use App\Consignee;
use App\Exporter;
use App\Fruit;
use App\Invoice;
use App\Loading;
use App\LoadingDetail;
use App\PortOfDischarge;
use App\PortOfLoading;
use App\Product;
use App\Shipment;
use App\Supplier;
use App\Unit;
use App\UnitPricing;
use App\User;
use App\Van;
use App\VanDetail;
use App\Vessel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');



        Unit::truncate();
        Product::truncate();
        User::truncate();
        Carrier::truncate();
        Exporter::truncate();
        Invoice::truncate();
        Loading::truncate();
        PortOfDischarge::truncate();
        PortOfLoading::truncate();
        Supplier::truncate();
        Van::truncate();
        VanDetail::truncate();
        Vessel::truncate();
        LoadingDetail::truncate();
        Consignee::truncate();
        Fruit::truncate();


        DB::table('units')->insert(['value' => 13.5]);
        DB::table('units')->insert(['value' => 7.2]);
        DB::table('units')->insert(['value' => 5]);
        DB::table('units')->insert(['value' => 3]);

        DB::table('fruits')->insert(['name' => 'Banana']);

        DB::table('products')->insert(['name' => '4H', 'unit_id' => 1, 'fruit_id' => 1 ,'class' => 'A']);
        DB::table('products')->insert(['name' => '5H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '6H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '7H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '8H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '7kg', 'unit_id' => 2, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '5kg', 'unit_id' => 3, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => '3kg', 'unit_id' => 4, 'fruit_id' => 1 , 'class' => 'A']);
        DB::table('products')->insert(['name' => 'CL', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '4H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '5H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '6H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '7H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '8H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);
        DB::table('products')->insert(['name' => '9H', 'unit_id' => 1, 'fruit_id' => 1 , 'class' => 'B']);




        $userQuantity = 10;
        $podQuantity = 20;
        $polQuantity = 20;
        $supplierQuantity = 30;
        $vesselQuantity = 30;
        $carrierQuantity = 30;
        $exporterQuantity = 30;
        $consigneeQuantity=30;


        factory(User::class, $userQuantity)->create();
        factory(PortOfDischarge::class, $podQuantity)->create();
        factory(PortOfLoading::class, $polQuantity)->create();
        factory(Supplier::class, $supplierQuantity)->create();
        factory(Vessel::class, $vesselQuantity)->create();
        factory(Carrier::class, $carrierQuantity)->create();
        factory(Exporter::class, $exporterQuantity)->create();
        factory(Consignee::class, $consigneeQuantity)->create();
        //factory(Loading::class, 2)->create();



//        DB::table('loading_details')->insert([
//            'loading_id' => 1,
//            'BL_no' => '12412412',
//            'productionWeek' => '22',
//            'shipmentWeek' => '23',
//            'ETD' => Carbon::now(),
//            'ETA' => Carbon::now(),
//            'voyage_no' => 'V.071',
//            'status' => LoadingDetail::APPROVED,
//            'year' => '2018',
//            'portOfDischarge_id' => 1,
//            'portOfLoading_id' => 1,
//            'exporter_id' => 1,
//            'carrier_id' => 1,
//            'vessel' => 'SAD' ]);
//        DB::table('loading_details')->insert([
//            'supplier_id' => 1,
//            'loading_id' => 2,
//            'BL_no' => '12412412',
//            'productionWeek' => '22',
//            'shipmentWeek' => '23',
//            'ETD' => Carbon::now(),
//            'ETA' => Carbon::now(),
//            'voyage_no' => 'V.071',
//            'status' => LoadingDetail::APPROVED,
//            'year' => '2018',
//            'portOfDischarge_id' => 1,
//            'portOfLoading_id' => 1,
//            'exporter_id' => 1,
//            'carrier_id' => 1,
//            'vessel' => 'SAS' ]);
//        DB::table('vans')->insert(['loading_id' => 1, 'van_no' => 'CGMU9396385', 'seal_no' => 'CNC3259632']);
//        DB::table('vans')->insert(['loading_id' => 1, 'van_no' => 'CXRU1084568', 'seal_no' => 'G0825385']);
//        DB::table('vans')->insert(['loading_id' => 2, 'van_no' => 'XCFE9396385', 'seal_no' => 'CNC3259632']);
//        DB::table('vans')->insert(['loading_id' => 2, 'van_no' => 'FEET1084568', 'seal_no' => 'G0825385']);
//        DB::table('vans')->insert(['loading_id' => 2, 'van_no' => 'GEEY1084568', 'seal_no' => 'G0825385']);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 1, 'quantity' => 163]);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 2, 'quantity' => 230]);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 3, 'quantity' => 674]);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 7, 'quantity' => 374]);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 8, 'quantity' => 519]);
//        DB::table('van_details')->insert(['van_id' => 1, 'product_id' => 9, 'quantity' => 110]);
//
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 1, 'quantity' => 121]);
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 2, 'quantity' => 129]);
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 4, 'quantity' => 630]);
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 7, 'quantity' => 174]);
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 14, 'quantity' => 1080]);
//        DB::table('van_details')->insert(['van_id' => 2, 'product_id' => 15, 'quantity' => 475]);
//
//        DB::table('invoices')->insert(['loading_id' => 1, 'BL_no' => 'sdjfiwe', 'term' => Invoice::TERM_FOB]);
//        DB::table('unit_pricings')->insert(['unit_id' => 1, 'price' => 7.66, 'shipment_id' => 1]);
//        DB::table('unit_pricings')->insert(['unit_id' => 2, 'price' => 3.70, 'shipment_id' => 1]);
//        DB::table('unit_pricings')->insert(['unit_id' => 3, 'price' => 2.63, 'shipment_id' => 1]);
//        DB::table('unit_pricings')->insert(['unit_id' => 4, 'price' => 1.97, 'shipment_id' => 1]);
    }
}
