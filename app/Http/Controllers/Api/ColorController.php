<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return Color::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'CodigoColor' => 'required|string|max:10',
            'NombreColor' => 'nullable|string|max:30'
        ]);

        $color = Color::create($request->all());
        return response()->json($color, 201);
    }

    public function show($id)
    {
        $color = Color::findOrFail($id);
        return response()->json($color);
    }

    public function update(Request $request, $id)
    {
        $color = Color::findOrFail($id);
        $request->validate([
            'CodigoColor' => 'sometimes|string|max:10',
            'NombreColor' => 'nullable|string|max:30'
        ]);
        $color->update($request->all());
        return response()->json($color, 200);
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return response()->json(null, 204);
    }
}
