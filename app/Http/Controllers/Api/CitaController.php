<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // GET /api/citas -> lista con paciente (usuario) y médico (usuario + especialidad)
    public function index()
    {
        $citas = Cita::with([
            'pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.especialidad:id_especialidad,nombre',
        ])->get();

        return response()->json($citas, 200);
    }

    // GET /api/citas/{id}
    public function show($id)
    {
        $cita = Cita::with([
            'pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.especialidad:id_especialidad,nombre',
        ])->find($id);

        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita, 200);
    }

    // POST /api/citas -> recibe SOLO ids; devuelve con relaciones cargadas
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario'   => 'required|exists:usuarios,id_usuario',  // paciente (usuario)
            'id_medico'    => 'required|exists:medicos,id_medico',
            'fecha'        => 'required|date',
            'hora_inicio'  => 'required',
            'hora_fin'     => 'required',
            'estado'       => 'nullable|string|max:20',
            'motivo'       => 'nullable|string|max:255',
            'observaciones'=> 'nullable|string|max:255',
            'consultorio'  => 'nullable|string|max:100',
        ]);

        $cita = Cita::create($request->only([
            'id_usuario','id_medico','fecha','hora_inicio','hora_fin',
            'estado','motivo','observaciones','consultorio'
        ]));

        $cita->load([
            'pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.especialidad:id_especialidad,nombre',
        ]);

        return response()->json($cita, 201);
    }

    // PUT /api/citas/{id} -> puede cambiar ids y/o datos propios
    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return response()->json(['mensaje' => 'Cita no encontrada'], 404);
        }

        $request->validate([
            'id_usuario'   => 'sometimes|exists:usuarios,id_usuario',
            'id_medico'    => 'sometimes|exists:medicos,id_medico',
            'fecha'        => 'sometimes|date',
            'hora_inicio'  => 'sometimes',
            'hora_fin'     => 'sometimes',
            'estado'       => 'sometimes|nullable|string|max:20',
            'motivo'       => 'sometimes|nullable|string|max:255',
            'observaciones'=> 'sometimes|nullable|string|max:255',
            'consultorio'  => 'sometimes|nullable|string|max:100',
        ]);

        $cita->fill($request->only([
            'id_usuario','id_medico','fecha','hora_inicio','hora_fin',
            'estado','motivo','observaciones','consultorio'
        ]));
        $cita->save();

        $cita->load([
            'pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'medico.especialidad:id_especialidad,nombre',
        ]);

        return response()->json($cita, 200);
    }

    // DELETE /api/citas/{id}
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
