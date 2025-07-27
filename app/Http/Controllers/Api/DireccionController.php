<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    public function index()
    {
        return Direccion::all();
    }

    public function store(Request $request)
    {
        $direccion = Direccion::create($request->all());
        return response()->json($direccion, 201);
    }

    public function show($id)
    {
        return Direccion::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->update($request->all());
        return response()->json($direccion, 200);
    }

    public function destroy($id)
    {
        Direccion::destroy($id);
        return response()->json(null, 204);
    }
}
