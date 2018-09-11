<?php

namespace App\Http\Controllers\Container;

use App\Van;
use App\VanDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ContainerController extends Controller
{

    public function show($first, $second)
    {

        return View::make('addProductContainer.show')
            ->with(compact('first'))
            ->with(compact('second'));
    }

    public function getContainer($first, $second)
    {
        $container = Van::with('vanDetails.product.unit')
            ->with('vanDetails.product.fruit')
            ->where('id', '=', $second)->first();
        return response()->json($container, 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $van = Van::findOrFail($data['van_id']);
        $vanDetails = $van->vanDetails()->create($data);
        return response()->json($vanDetails, 200);
    }

    public function update(Request $request, $van, $van_id)
    {
        $vanDetail = VanDetail::findOrFail($van_id);
        $data = $request->all();

        $vanDetail->quantity = $data['quantity'];
        $vanDetail->product_id = $data['product_id'];
        $vanDetail->save();
        return response()->json($vanDetail, 200);
    }

    public function updateSeal(Request $request, $id1, $id2)
    {

        $data = $request->all();
        $van = Van::findOrFail($id2);
        $van->seal_no = $data['seal_no'];
        $van->save();
        return response()->json($data['seal_no'], 200);
    }
}
