<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function index()
    {
        return Vehiculo::all();
    }

    public function store(Request $request)
    {
        $vehiculo = Vehiculo::create($request->all());
        return response()->json($vehiculo, 201);
    }

    public function show($id)
    {
        return Vehiculo::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->all());
        return response()->json($vehiculo, 200);
    }

    public function destroy($id)
    {
        Vehiculo::destroy($id);
        return response()->json(null, 204);
    }
}
