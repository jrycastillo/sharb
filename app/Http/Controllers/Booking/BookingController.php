<?php

namespace App\Http\Controllers\Booking;

use App\Carrier;
use App\Exporter;
use App\Loading;
use App\LoadingDetail;
use App\PortOfDischarge;
use App\PortOfLoading;
use App\Supplier;
use App\Van;
use App\Vessel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     *
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loadings = LoadingDetail::all()
            ->where('rev', '=', LoadingDetail::NEW)
            ->where('status', '=', LoadingDetail::BOOKING);


        return View::make('booking.index')
            ->with(compact('loadings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        $vessels = Vessel::pluck('name', 'id')->all();
        $exporters = Exporter::pluck('name', 'id')->all();
        $carriers = Carrier::pluck('name', 'id')->all();
        $suppliers = Supplier::pluck('name', 'id')->all();
        $portOfLoadings = PortOfLoading::pluck('city', 'id')->all();
        $portOfDischarges = PortOfDischarge::pluck('city', 'id')->all();
        $years = range(Carbon::now()->year, 2010);

        return View::make('booking.create')
            ->with(compact('vessels'))
            ->with(compact('exporters'))
            ->with(compact('carriers'))
            ->with(compact('suppliers'))
            ->with(compact('portOfDischarges'))
            ->with(compact('portOfLoadings'))
            ->with(compact('years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $loading = Loading::create();

        $data = $request->all();
        $data['formData']['shipmentWeek'] = Carbon::parse($data['formData']['ETD'])->weekOfYear;
        $data['formData']['loading_id'] = $loading->id;
        $data['formData']['BL_no'] = strtoupper($data['formData']['BL_no']);
        $data['formData']['year'] = Carbon::parse($data['formData']['ETD'])->year;

        LoadingDetail::create($data['formData']);

        foreach ($data['containers'] as $d) {
            $d['loading_id'] = $loading->id;
            $d['van_no'] = strtoupper($d['van_no']);
            Van::create($d);
        }


        //return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {

        $loadingDetail = DB::table('loading_details')
            ->select('loading_details.id', 'BL_no', 'vessel', 'port_of_discharges.city as POD',
                'port_of_loadings.city as POL', 'exporters.name as exporter', 'carriers.name as carrier', 'productionWeek',
                'shipmentWeek', 'ETD', 'ETA', 'voyage_no', 'year', 'status')
            ->join('port_of_discharges', 'portOfDischarge_id', '=', 'port_of_discharges.id')
            ->join('port_of_loadings', 'portOfLoading_id', '=', 'port_of_loadings.id')
            ->join('exporters', 'exporter_id', '=', 'exporters.id')
            ->join('carriers', 'carrier_id', '=', 'carriers.id')
            ->where('loading_details.id', '=', $id)
            ->first();


        return View::make('booking.show')
            ->with(compact('loadingDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $loadingDetail = DB::table('loading_details')
            ->select('loading_details.id', 'BL_no', 'vessel', 'port_of_discharges.city as POD',
                'port_of_loadings.city as POL', 'exporters.name as exporter', 'carriers.name as carrier', 'productionWeek',
                'shipmentWeek', 'ETD', 'ETA', 'voyage_no', 'year', 'status')
            ->join('port_of_discharges', 'portOfDischarge_id', '=', 'port_of_discharges.id')
            ->join('port_of_loadings', 'portOfLoading_id', '=', 'port_of_loadings.id')
            ->join('exporters', 'exporter_id', '=', 'exporters.id')
            ->join('carriers', 'carrier_id', '=', 'carriers.id')
            ->where('loading_details.id', '=', $id)
            ->first();

        return View::make('booking.edit')
            ->with(compact('loadingDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
