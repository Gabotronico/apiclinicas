<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    // GET /api/medicos -> lista con usuario y especialidad anidados
    public function index()
    {
        $medicos = Medico::with([
            'usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'especialidad:id_especialidad,nombre'
        ])->get();

        return response()->json($medicos, 200);
    }

    // GET /api/medicos/{id} -> detalle con usuario y especialidad
    public function show($id)
    {
        $medico = Medico::with([
            'usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'especialidad:id_especialidad,nombre'
        ])->find($id);

        if (!$medico) {
            return response()->json(['mensaje' => 'Médico no encontrado'], 404);
        }

        return response()->json($medico, 200);
    }

    // POST /api/medicos -> recibe SOLO ids (id_usuario, id_especialidad)
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario'      => 'required|exists:usuarios,id_usuario',
            'id_especialidad' => 'required|exists:especialidades,id_especialidad',
            'telefono'        => 'nullable|string|max:20',
        ]);

        $medico = Medico::create([
            'id_usuario'      => $request->id_usuario,
            'id_especialidad' => $request->id_especialidad,
            'telefono'        => $request->telefono,
        ]);

        // Devolver con relaciones cargadas
        $medico->load([
            'usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'especialidad:id_especialidad,nombre'
        ]);

        return response()->json($medico, 201);
    }

    // PUT /api/medicos/{id} -> puede cambiar ids o teléfono
    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);
        if (!$medico) {
            return response()->json(['mensaje' => 'Médico no encontrado'], 404);
        }

        $request->validate([
            'id_usuario'      => 'sometimes|exists:usuarios,id_usuario',
            'id_especialidad' => 'sometimes|exists:especialidades,id_especialidad',
            'telefono'        => 'sometimes|nullable|string|max:20',
        ]);

        $medico->fill($request->only(['id_usuario','id_especialidad','telefono']));
        $medico->save();

        $medico->load([
            'usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'especialidad:id_especialidad,nombre'
        ]);

        return response()->json($medico, 200);
    }

    // DELETE /api/medicos/{id}
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
