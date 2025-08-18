<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    // Mostrar todas las especialidades
    public function index()
    {
        return response()->json(Especialidad::all(), 200);
    }

    // Registrar una nueva especialidad
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $especialidad = Especialidad::create($request->all());

        return response()->json($especialidad, 201);
    }

    // Mostrar una especialidad por ID
    public function show($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json(['mensaje' => 'Especialidad no encontrada'], 404);
        }

        return response()->json($especialidad, 200);
    }

    // Actualizar especialidad
    public function update(Request $request, $id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json(['mensaje' => 'Especialidad no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $especialidad->update($request->all());

        return response()->json($especialidad, 200);
    }

    // Eliminar especialidad
    public function destroy($id)
    {
        $especialidad = Especialidad::find($id);

        if (!$especialidad) {
            return response()->json(['mensaje' => 'Especialidad no encontrada'], 404);
        }

        $especialidad->delete();

        return response()->json(['mensaje' => 'Especialidad eliminada'], 200);
    }
}
