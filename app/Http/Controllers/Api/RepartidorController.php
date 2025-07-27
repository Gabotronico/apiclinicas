<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repartidor;
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    public function index()
    {
        return Repartidor::all();
    }

    public function store(Request $request)
    {
        $repartidor = Repartidor::create($request->all());
        return response()->json($repartidor, 201);
    }

    public function show($id)
    {
        return Repartidor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $repartidor = Repartidor::findOrFail($id);
        $repartidor->update($request->all());
        return response()->json($repartidor, 200);
    }

    public function destroy($id)
    {
        Repartidor::destroy($id);
        return response()->json(null, 204);
    }
}
