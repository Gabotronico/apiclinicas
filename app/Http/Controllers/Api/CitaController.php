<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Mostrar todas las citas
    public function index()
    {
        return response()->json(Cita::all(), 200);
    }

    // Registrar una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_medico' => 'required|exists:medicos,id_medico',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'nullable|string|max:20',
            'motivo' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:255',
            'consultorio' => 'nullable|string|max:100',
        ]);

        $cita = Cita::create($request->all());

        return response()->json($cita, 201);
    }

    // Mostrar una cita específica
    public function show($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita, 200);
    }

    // Actualizar una cita
    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'id_medico' => 'required|exists:medicos,id_medico',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'estado' => 'nullable|string|max:20',
            'motivo' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string|max:255',
            'consultorio' => 'nullable|string|max:100',
        ]);

        $cita->update($request->all());

        return response()->json($cita, 200);
    }

    // Eliminar una cita
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $cita->delete();

        return response()->json(['mensaje' => 'Cita eliminada correctamente'], 200);
    }
}
