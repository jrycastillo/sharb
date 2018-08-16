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

    public function update(Request $request, Van $van, $van_id)
    {
        $vanDetail = VanDetail::findOrFail($van_id);
        $vanDetail->fill($request->only([
            'product_id',
            'quantity'
        ]));
        $vanDetail->save();
        return response()->json($vanDetail, 200);
    }
}
