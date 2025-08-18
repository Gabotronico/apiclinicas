<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    // Mostrar todos los médicos
    public function index()
    {
        return response()->json(Medico::all(), 200);
    }

    // Registrar un nuevo médico
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:100',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad', // corregido
        ]);

        $medico = Medico::create([
            'id_usuario' => $request->id_usuario,
            'id_especialidad' => $request->id_especialidad,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        return response()->json($medico, 201);
    }

    // Mostrar un médico específico
    public function show($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'Médico no encontrado'], 404);
        }

        return response()->json($medico, 200);
    }

    // Actualizar un médico
    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'Médico no encontrado'], 404);
        }

        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:100',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad', // corregido
        ]);

        $medico->update([
            'id_usuario' => $request->id_usuario,
            'id_especialidad' => $request->id_especialidad,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        return response()->json($medico, 200);
    }

    // Eliminar un médico
    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'Médico no encontrado'], 404);
        }

        $medico->delete();

        return response()->json(['mensaje' => 'Médico eliminado'], 200);
    }
}
