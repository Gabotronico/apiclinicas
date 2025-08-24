<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    // GET /api/consultas -> lista con relaciones anidadas
    public function index()
    {
        $consultas = Consulta::with([
            // Cita y sus relaciones
            'cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.especialidad:id_especialidad,nombre',
            // Médico de la consulta (usuario)
            'medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            // Paciente (modelo Paciente) + su usuario
            'paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            // Análisis (si tienes esa relación en el modelo)
            'analisis:id_analisis,id_consulta,tipo,resultado,observaciones,fecha,created_at'
        ])->get();

        return response()->json($consultas, 200);
    }

    // GET /api/consultas/{id}
    public function show($id)
    {
        $consulta = Consulta::with([
            'cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.especialidad:id_especialidad,nombre',
            'medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'analisis:id_analisis,id_consulta,tipo,resultado,observaciones,fecha,created_at'
        ])->find($id);

        if (!$consulta) {
            return response()->json(['mensaje' => 'Consulta no encontrada'], 404);
        }

        return response()->json($consulta, 200);
    }

    // POST /api/consultas -> recibe SOLO ids; devuelve con relaciones cargadas
    public function store(Request $request)
    {
        $request->validate([
            'id_cita'      => 'required|exists:citas,id_cita',
            'id_usuario'   => 'required|exists:usuarios,id_usuario',   // médico (usuario)
            'id_paciente'  => 'required|exists:pacientes,id_paciente', // paciente (modelo Paciente)
            'motivo'       => 'nullable|string|max:255',
            'diagnostico'  => 'nullable|string|max:255',
            'tratamiento'  => 'nullable|string',
            'indicaciones' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
        ]);

        $consulta = Consulta::create($request->only([
            'id_cita','id_usuario','id_paciente',
            'motivo','diagnostico','tratamiento','indicaciones','proxima_cita'
        ]));

        $consulta->load([
            'cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.especialidad:id_especialidad,nombre',
            'medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'analisis:id_analisis,id_consulta,tipo,resultado,observaciones,fecha,created_at'
        ]);

        return response()->json($consulta, 201);
    }

    // PUT /api/consultas/{id} -> actualizar ids o campos propios
    public function update(Request $request, $id)
    {
        $consulta = Consulta::find($id);
        if (!$consulta) {
            return response()->json(['mensaje' => 'Consulta no encontrada'], 404);
        }

        $request->validate([
            'id_cita'      => 'sometimes|exists:citas,id_cita',
            'id_usuario'   => 'sometimes|exists:usuarios,id_usuario',
            'id_paciente'  => 'sometimes|exists:pacientes,id_paciente',
            'motivo'       => 'sometimes|nullable|string|max:255',
            'diagnostico'  => 'sometimes|nullable|string|max:255',
            'tratamiento'  => 'sometimes|nullable|string',
            'indicaciones' => 'sometimes|nullable|string',
            'proxima_cita' => 'sometimes|nullable|date',
        ]);

        $consulta->fill($request->only([
            'id_cita','id_usuario','id_paciente',
            'motivo','diagnostico','tratamiento','indicaciones','proxima_cita'
        ]));
        $consulta->save();

        $consulta->load([
            'cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'cita.medico.especialidad:id_especialidad,nombre',
            'medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'analisis:id_analisis,id_consulta,tipo,resultado,observaciones,fecha,created_at'
        ]);

        return response()->json($consulta, 200);
    }

    // DELETE /api/consultas/{id}
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
