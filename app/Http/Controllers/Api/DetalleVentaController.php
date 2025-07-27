<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        return DetalleVenta::all();
    }

    public function store(Request $request)
    {
        $detalle = DetalleVenta::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        return DetalleVenta::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleVenta::findOrFail($id);
        $detalle->update($request->all());
        return response()->json($detalle, 200);
    }

    public function destroy($id)
    {
        DetalleVenta::destroy($id);
        return response()->json(null, 204);
    }
}
