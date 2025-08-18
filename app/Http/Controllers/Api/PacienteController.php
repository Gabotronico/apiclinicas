<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // Mostrar todos los pacientes
    public function index()
    {
        return response()->json(Paciente::with('usuario')->get(), 200);
    }

    // Registrar un nuevo paciente
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'ci' => 'nullable|string|max:20',
            'fecha_nac' => 'nullable|date',
            'sexo' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);

        $paciente = Paciente::create($request->all());

        return response()->json($paciente, 201);
    }

    // Mostrar un paciente por ID
    public function show($id)
    {
        $paciente = Paciente::with('usuario')->find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente, 200);
    }

    // Actualizar paciente
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        $request->validate([
            'ci' => 'nullable|string|max:20',
            'fecha_nac' => 'nullable|date',
            'sexo' => 'nullable|string|max:10',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'direccion' => 'nullable|string|max:255',
        ]);

        $paciente->update($request->all());

        return response()->json($paciente, 200);
    }

    // Eliminar paciente
    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(['mensaje' => 'Paciente eliminado'], 200);
    }
}
