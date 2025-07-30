<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function index()
    {
        return Imagen::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'UrlImagen' => 'required|string|max:150'
        ]);

        $imagen = Imagen::create($request->all());
        return response()->json($imagen, 201);
    }

    public function show($id)
    {
        $imagen = Imagen::findOrFail($id);
        return response()->json($imagen);
    }

    public function update(Request $request, $id)
    {
        $imagen = Imagen::findOrFail($id);
        $request->validate([
            'UrlImagen' => 'sometimes|string|max:150'
        ]);
        $imagen->update($request->all());
        return response()->json($imagen, 200);
    }

    public function destroy($id)
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->delete();
        return response()->json(null, 204);
    }
}
