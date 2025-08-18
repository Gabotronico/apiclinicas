<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Obtener todos los roles
    public function index()
    {
        return response()->json(Rol::all(), 200);
    }

    // Crear un nuevo rol
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        $rol = Rol::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json($rol, 201);
    }

    // Mostrar un rol específico
    public function show($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol, 200);
    }

    // Actualizar un rol
    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:50',
        ]);

        $rol->update([
            'nombre' => $request->nombre,
        ]);

        return response()->json($rol, 200);
    }

    // Eliminar un rol
    public function destroy($id)
    {
        $rol = Rol::find($id);
        if (!$rol) {
            return response()->json(['mensaje' => 'Rol no encontrado'], 404);
        }

        $rol->delete();

        return response()->json(['mensaje' => 'Rol eliminado'], 200);
    }
}
