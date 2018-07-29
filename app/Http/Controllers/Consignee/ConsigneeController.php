<?php

namespace App\Http\Controllers\Consignee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Consignee;

class ConsigneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $consignees = Consignee::all();

        //dd($suppliers);
        return View::make('Consignee.index')->with(compact('consignees'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->all();

        $data['name'] =strtoupper($data['name']);
        $data['postal'] =strtoupper($data['postal']);
        $data['address'] =strtoupper($data['address']);
        $data['city'] =strtoupper($data['name']);
        $data['country'] =strtoupper($data['country']);
        $data['contact'] =strtoupper($data['contact']);

        Consignee::create($data);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $consignee = Consignee::findOrFail($id);
        $data = $request->all();

        $consignee['name'] = strtoupper($data['name']);
        $consignee['postal'] = strtoupper($data['postal']);
        $consignee['address'] = strtoupper($data['address']);
        $consignee['city'] = strtoupper($data['city']);
        $consignee['country'] = strtoupper($data['country']);
        $consignee['contact'] = strtoupper($data['contact']);

        $consignee->save();




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $consignee = Consignee::findOrFail($id);
        $consignee->delete();
    }
}
