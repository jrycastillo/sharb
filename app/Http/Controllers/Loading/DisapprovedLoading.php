<?php

namespace App\Http\Controllers\Loading;

use App\Loading;
use App\LoadingDetail;
use App\Product;
use App\VanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class DisapprovedLoading extends Controller
{

    public function index()
    {
        return View::make('disapprovedloading.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $loading = LoadingDetail::findOrFail($id);
        $variable = '&';

        $loadingDetail = DB::table('loading_details')
            ->select('loading_details.id', 'BL_no', 'suppliers.name as supplier', 'vessel', 'port_of_discharges.city as POD',
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





        return View::make('disapprovedloading.show')
            ->with(compact('loadingDetail'))
            ->with(compact('id'))
            ->with(compact('variable'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function getLoading(Request $request)
    {
        $searchType = $request->query('type');

        switch ($searchType) {
            case ($searchType === 'year'):
                $year = $request->query('year');
                $loadingDetails = LoadingDetail::all()
                    ->where('rev', '=', LoadingDetail::NEW)
                    ->where('status', '=', LoadingDetail::DISAPPROVED)
                    ->where('year', '=', $year)
                    ->groupBy('productionWeek');
                return response()->json($loadingDetails,200);
            case ($searchType === 'loading'):
                $id = $request->query('id');
                $data = Loading::findOrFail($id)
                    ->vans()
                    ->with('vanDetails.product.unit')
                    ->get();
                return response()->json($data,200);
            case ($searchType === 'product'):
                $data = Product::with('unit')->get();
                return response()->json($data,200);
            case ($searchType === 'size'):
                $data = VanDetail::orderBy('id', 'DESC')->first();
                return response()->json($data->id,200);
        }
    }

}
