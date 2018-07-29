<?php

namespace App\Http\Controllers\Loading;

use App\Loading;
use App\LoadingDetail;
use App\Product;
use App\Supplier;
use App\VanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class LoadingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $loadingDetails = LoadingDetail::all()->where('rev', LoadingDetail::NEW)->groupBy('productionWeek');
        $loadings = Loading::with('loadingDetails')->get();

        $years = collect(['2018', '2017']);


        return View::make('loading.index')
            ->with(compact('loadingDetails'))
            ->with(compact('years'))
            ->with(compact('loadings'));
    }


    public function create()
    {
        $bl_no = LoadingDetail::all()
            ->where('rev','=', LoadingDetail::NEW)
            ->where('status','=',LoadingDetail::BOOKING);


        $suppliers = Supplier::pluck('name', 'id')->all();

        return View::make('loading.create')
            ->with(compact('bl_no'))
            ->with(compact('suppliers'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Loading $loading)
    {

        $loadingDetail = DB::table('loading_details')
            ->select('BL_no', 'suppliers.name as supplier', 'vessel', 'port_of_discharges.city as POD',
                'port_of_loadings.city as POL', 'exporters.name as exporter', 'carriers.name as carrier', 'productionWeek',
                'shipmentWeek', 'ETD', 'ETA', 'voyage_no', 'year', 'status')
            ->join('suppliers', 'supplier_id', '=', 'suppliers.id')
            ->join('port_of_discharges', 'portOfDischarge_id', '=', 'port_of_discharges.id')
            ->join('port_of_loadings', 'portOfLoading_id', '=', 'port_of_loadings.id')
            ->join('exporters', 'exporter_id', '=', 'exporters.id')
            ->join('carriers', 'carrier_id', '=', 'carriers.id')
            ->where('loading_id', '=', $loading->id)
            ->where('rev', '=', LoadingDetail::NEW)
            ->first();


        $vanDetails = $loading
            ->vans()
            ->with('vanDetails.product.unit')
            ->get();


        $productHead = DB::table('vans')
            ->select('products.id', 'products.name', 'products.class', 'units.value', DB::raw('SUM(van_details.quantity) as quantity'))
            ->join('van_details', 'van_details.van_id', '=', 'vans.id')
            ->join('loadings', 'loadings.id', '=', 'loading_id')
            ->join('products', 'products.id', '=', 'van_details.product_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->where('loadings.id', '=', $loading->id)
            ->where('products.class', '=', Product::CLASS_A)
            ->groupBy('products.name')
            ->orderBy('units.value', 'desc')
            ->get();
        $productHeadB = DB::table('vans')
            ->select('products.id', 'products.name', 'products.class', 'units.value', DB::raw('SUM(van_details.quantity) as quantity'))
            ->join('van_details', 'van_details.van_id', '=', 'vans.id')
            ->join('loadings', 'loadings.id', '=', 'loading_id')
            ->join('products', 'products.id', '=', 'van_details.product_id')
            ->join('units', 'units.id', '=', 'products.unit_id')
            ->where('loadings.id', '=', $loading->id)
            ->where('products.class', '=', Product::CLASS_B)
            ->groupBy('products.name')
            ->orderBy('units.value', 'desc')
            ->get();

        $results = $productHead->merge($productHeadB);

        $datas = new Collection();
        $isEmpty = 'true';


        foreach ($vanDetails as $products) {
            $items = new Collection();
            $total = 0;
            foreach ($results as $result) {
                $check = 'true';
                foreach ($products->vanDetails as $product) {
                    if ($result->id === $product->product_id) {
                        $items->push($product->quantity);
                        $total += $product->quantity;
                        $check = 'false';
                        break;
                    }
                }
                if ($check === 'true') {
                    $items->push('');
                }
            }
            $items->push($total);
            $datas->push(['van_no' => $products->van_no, 'items' => $items]);
            if ($total != 0) {
                $isEmpty = 'false';
            }
        }

        $sum = $results->sum('quantity');


        return View::make('loading.show')
            ->with(compact('results'))
            ->with(compact('loadingDetail'))
            ->with(compact('datas'))
            ->with(compact('productHead'))
            ->with(compact('productHeadB'))
            ->with(compact('sum'))
            ->with(compact('vanDetails'))
            ->with(compact('isEmpty'));

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $loadingDetail = LoadingDetail::findOrFail($id);

        $loadingDetail['status'] = LoadingDetail::ADDPRODUCT;
        $loadingDetail['productionWeek'] = $data['productionWeek'];
        $loadingDetail['supplier_id'] = $data['supplier_id'];

        $loadingDetail->save();

        //return response()->json($loadingDetail);

    }


    public function destroy($id)
    {
        //
    }


    public function getLoading()
    {
        $loading_id = Input::get('BL_no');

        $loadingDetail = DB::table('loading_details')
            ->select('BL_no', 'vessel', 'port_of_discharges.city as POD',
                'port_of_loadings.city as POL', 'exporters.name as exporter', 'carriers.name as carrier',
                'shipmentWeek', 'ETD', 'ETA', 'voyage_no', 'year', 'status')
            ->join('port_of_discharges', 'portOfDischarge_id', '=', 'port_of_discharges.id')
            ->join('port_of_loadings', 'portOfLoading_id', '=', 'port_of_loadings.id')
            ->join('exporters', 'exporter_id', '=', 'exporters.id')
            ->join('carriers', 'carrier_id', '=', 'carriers.id')
            ->where('loading_details.id', '=', $loading_id)
            ->where('rev', '=', LoadingDetail::NEW)
            ->first();
        return response()->json($loadingDetail);


    }
}
