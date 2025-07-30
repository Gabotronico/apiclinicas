<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Si quieres incluir el nombre de la talla, color e imagen asociada:
        return Producto::with(['talla', 'color', 'imagen'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'NombreProducto' => 'required|string|max:50',
            'Precio'         => 'required|numeric',
            'IdCategoria'    => 'required|integer',
            'Stock'          => 'required|integer',
            'IdTalla'        => 'nullable|exists:tallas,IdTalla',
            'IdColor'        => 'nullable|exists:colores,IdColor',
            'IdImagen'       => 'nullable|exists:imagenes,IdImagen',
            'Archivo_RA'     => 'nullable|string|max:50'
        ]);

        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::with(['talla', 'color', 'imagen'])->findOrFail($id);
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'NombreProducto' => 'sometimes|string|max:50',
            'Precio'         => 'sometimes|numeric',
            'IdCategoria'    => 'sometimes|integer',
            'Stock'          => 'sometimes|integer',
            'IdTalla'        => 'nullable|exists:tallas,IdTalla',
            'IdColor'        => 'nullable|exists:colores,IdColor',
            'IdImagen'       => 'nullable|exists:imagenes,IdImagen',
            'Archivo_RA'     => 'nullable|string|max:50'
        ]);

        $producto->update($request->all());
        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(null, 204);
    }
}

