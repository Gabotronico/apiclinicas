<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HorarioMedico;
use Illuminate\Http\Request;

class HorarioMedicoController extends Controller
{
    public function index()
    {
        return response()->json(HorarioMedico::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_medico' => 'required|exists:medicos,id_medico',
            'dia_semana' => 'required|string|max:15',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'estado' => 'in:activo,inactivo',
        ]);

        $horario = HorarioMedico::create($request->all());

        return response()->json($horario, 201);
    }

    public function show($id)
    {
        $horario = HorarioMedico::find($id);
        if (!$horario) {
            return response()->json(['mensaje' => 'Horario no encontrado'], 404);
        }

        return response()->json($horario, 200);
    }

    public function update(Request $request, $id)
    {
        $horario = HorarioMedico::find($id);
        if (!$horario) {
            return response()->json(['mensaje' => 'Horario no encontrado'], 404);
        }

        $request->validate([
            'id_medico' => 'required|exists:medicos,id_medico',
            'dia_semana' => 'required|string|max:15',
            'hora_inicio' => 'required|date_format:H:i:s',
            'hora_fin' => 'required|date_format:H:i:s|after:hora_inicio',
            'estado' => 'in:activo,inactivo',
        ]);

        $horario->update($request->all());

        return response()->json($horario, 200);
    }

    public function destroy($id)
    {
        $horario = HorarioMedico::find($id);
        if (!$horario) {
            return response()->json(['mensaje' => 'Horario no encontrado'], 404);
        }

        $horario->delete();
        return response()->json(['mensaje' => 'Horario eliminado'], 200);
    }
}
