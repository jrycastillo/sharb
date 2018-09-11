<?php

namespace App\Http\Controllers\Pricing;

use App\LoadingDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PricingController extends Controller
{

    public function index()
    {
        //

        return View::make('pricing.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Request $request, $id)
    {
//        SELECT ld.supplier_id, u.id as unit_id,  l.id as loading_id, SUM(vd.quantity) as qty, u.value, ld.productionWeek, p.class
//        FROM loadings l
//        INNER JOIN vans v ON l.id = v.loading_id
//        INNER JOIN loading_details ld ON l.id = ld.loading_id
//        INNER JOIN van_details vd on v.id = vd.van_id
//        INNER JOIN products p ON vd.product_id = p.id
//        INNER JOIN units u ON p.unit_id = u.id
//        WHERE ld.productionWeek = 13
//        GROUP BY ld.supplier_id, u.id, p.class
//        ORDER BY u.value DESC, p.class

        $year = (int)$request->query('year');

        $pricings = DB::table('loadings')
            ->select('loading_details.supplier_id', 'units.id as unit_id', 'loadings.id as loading_id', 'units.value', 'loading_details.productionWeek', 'products.class', DB::raw('SUM(van_details.quantity) as qty'))
            ->join('vans', 'loadings.id', '=', 'vans.loading_id')
            ->join('loading_details', 'loadings.id', '=', 'loading_details.loading_id')
            ->join('van_details', 'vans.id', '=', 'van_details.van_id')
            ->join('products', 'van_details.product_id', '=', 'products.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->where('loading_details.productionWeek', '=', $id)
            ->where('loading_details.year', '=', $year)
            ->where('loading_details.rev', '=', LoadingDetail::NEW)
            ->where('loading_details.status', '=', LoadingDetail::APPROVED)
            ->groupBy('units.id', 'products.class')
            ->orderBy('units.value', 'desc')
            ->orderBy('products.class')
            ->get();

        $data = DB::table('loadings')
            ->select('loading_details.supplier_id', 'units.id as unit_id', 'loadings.id as loading_id', 'units.value', 'loading_details.productionWeek', 'products.class', DB::raw('SUM(van_details.quantity) as qty'))
            ->join('vans', 'loadings.id', '=', 'vans.loading_id')
            ->join('loading_details', 'loadings.id', '=', 'loading_details.loading_id')
            ->join('van_details', 'vans.id', '=', 'van_details.van_id')
            ->join('products', 'van_details.product_id', '=', 'products.id')
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->where('loading_details.productionWeek', '=', $id)
            ->where('loading_details.year', '=', $year)
            ->where('loading_details.rev', '=', LoadingDetail::NEW)
            ->where('loading_details.status', '=', LoadingDetail::APPROVED)
            ->groupBy('loading_details.supplier_id', 'units.id', 'products.class')
            ->orderBy('units.value', 'desc')
            ->orderBy('products.class')
            ->get();
        $suppliers = LoadingDetail::with('supplier')
            ->where('productionWeek', '=', $id)
            ->where('year', '=', $year)
            ->where('rev', '=', LoadingDetail::NEW)
            ->where('status', '=', LoadingDetail::APPROVED)
            ->get();

        return View::make('pricing.show')
            ->with(compact('pricings'))
            ->with(compact('data'))
            ->with(compact('id'))
            ->with(compact('suppliers'));

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
}
