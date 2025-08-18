<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // Mostrar todas las consultas
    public function index()
    {
        return response()->json(Consulta::all(), 200);
    }

    // Registrar una nueva consulta
    public function store(Request $request)
    {
        $request->validate([
            'id_cita' => 'required|exists:citas,id_cita',
            'id_usuario' => 'required|exists:usuarios,id_usuario', // Médico
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'motivo' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string|max:255',
            'tratamiento' => 'nullable|string|max:255',
            'indicaciones' => 'nullable|string|max:255',
            'proxima_cita' => 'nullable|date',
        ]);

        $consulta = Consulta::create($request->all());

        return response()->json($consulta, 201);
    }

    // Mostrar una consulta específica
    public function show($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['mensaje' => 'Consulta no encontrada'], 404);
        }

        return response()->json($consulta, 200);
    }

    // Actualizar una consulta
    public function update(Request $request, $id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['mensaje' => 'Consulta no encontrada'], 404);
        }

        $request->validate([
            'id_cita' => 'required|exists:citas,id_cita',
            'id_usuario' => 'required|exists:usuarios,id_usuario', // Médico
            'id_paciente' => 'required|exists:pacientes,id_paciente',
            'motivo' => 'nullable|string|max:255',
            'diagnostico' => 'nullable|string|max:255',
            'tratamiento' => 'nullable|string|max:255',
            'indicaciones' => 'nullable|string|max:255',
            'proxima_cita' => 'nullable|date',
        ]);

        $consulta->update($request->all());

        return response()->json($consulta, 200);
    }

    // Eliminar una consulta
    public function destroy($id)
    {
        $consulta = Consulta::find($id);

        if (!$consulta) {
            return response()->json(['mensaje' => 'Consulta no encontrada'], 404);
        }

        $consulta->delete();

        return response()->json(['mensaje' => 'Consulta eliminada correctamente'], 200);
    }
}
