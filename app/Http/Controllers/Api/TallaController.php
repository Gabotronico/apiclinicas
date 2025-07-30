<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function index()
    {
        return Talla::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NombreTalla' => 'required|string|max:10'
        ]);

        $talla = Talla::create($request->all());
        return response()->json($talla, 201);
    }

    public function show($id)
    {
        $talla = Talla::findOrFail($id);
        return response()->json($talla);
    }

    public function update(Request $request, $id)
    {
        $talla = Talla::findOrFail($id);
        $request->validate([
            'NombreTalla' => 'sometimes|string|max:10'
        ]);
        $talla->update($request->all());
        return response()->json($talla, 200);
    }

    public function destroy($id)
    {
        $talla = Talla::findOrFail($id);
        $talla->delete();
        return response()->json(null, 204);
    }
}