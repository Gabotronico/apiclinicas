<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    // GET /api/pacientes  -> lista con datos del usuario (nombres)
    public function index()
    {
        $pacientes = Paciente::with('usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email')
            ->get();

        return response()->json($pacientes, 200);
    }

    // GET /api/pacientes/{id} -> detalle con datos del usuario (nombres)
    public function show($id)
    {
        $paciente = Paciente::with('usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email')
            ->find($id);

        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        return response()->json($paciente, 200);
    }

    // POST /api/pacientes -> recibe SOLO id_usuario
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id_usuario',
            'ci'        => 'nullable|string|max:20',
            'fecha_nac' => 'nullable|date',
            'sexo'      => 'nullable|string|max:10',
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $paciente = Paciente::create($request->only([
            'id_usuario','ci','fecha_nac','sexo','telefono','direccion'
        ]));

        // Cargar nombres del usuario para el frontend
        $paciente->load('usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email');

        return response()->json($paciente, 201);
    }

    // PUT /api/pacientes/{id} -> puede cambiar id_usuario o datos propios
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
        }

        $request->validate([
            'id_usuario' => 'sometimes|exists:usuarios,id_usuario',
            'ci'        => 'sometimes|nullable|string|max:20',
            'fecha_nac' => 'sometimes|nullable|date',
            'sexo'      => 'sometimes|nullable|string|max:10',
            'telefono'  => 'sometimes|nullable|string|max:20',
            'direccion' => 'sometimes|nullable|string|max:255',
        ]);

        $paciente->fill($request->only(['id_usuario','ci','fecha_nac','sexo','telefono','direccion']));
        $paciente->save();

        $paciente->load('usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email');

        return response()->json($paciente, 200);
    }

    // DELETE /api/pacientes/{id}
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
