<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalisisLaboratorio;
use Illuminate\Http\Request;

class AnalisisLaboratorioController extends Controller
{
    // GET /api/analisis-laboratorio -> lista con consulta/cita/médico/paciente
    public function index()
    {
        $analisis = AnalisisLaboratorio::with([
            // Consulta
            'consulta.cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.especialidad:id_especialidad,nombre',
            // Médico de la consulta (usuario)
            'consulta.medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            // Paciente (modelo Paciente) + su usuario
            'consulta.paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
        ])->get();

        return response()->json($analisis, 200);
    }

    // GET /api/analisis-laboratorio/{id}
    public function show($id)
    {
        $analisis = AnalisisLaboratorio::with([
            'consulta.cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.especialidad:id_especialidad,nombre',
            'consulta.medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
        ])->find($id);

        if (!$analisis) {
            return response()->json(['mensaje' => 'Análisis no encontrado'], 404);
        }

        return response()->json($analisis, 200);
    }

    // POST /api/analisis-laboratorio -> recibe SOLO id_consulta; devuelve con relaciones cargadas
    public function store(Request $request)
    {
        $request->validate([
            'id_consulta'   => 'required|exists:consultas,id_consulta',
            'tipo'          => 'required|string|max:100',
            'resultado'     => 'nullable|string',
            'observaciones' => 'nullable|string',
            'fecha'         => 'nullable|date',
        ]);

        $analisis = AnalisisLaboratorio::create($request->only([
            'id_consulta','tipo','resultado','observaciones','fecha'
        ]));

        $analisis->load([
            'consulta.cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.especialidad:id_especialidad,nombre',
            'consulta.medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
        ]);

        return response()->json($analisis, 201);
    }

    // PUT /api/analisis-laboratorio/{id} -> actualizar campos; devuelve con relaciones cargadas
    public function update(Request $request, $id)
    {
        $analisis = AnalisisLaboratorio::find($id);
        if (!$analisis) {
            return response()->json(['mensaje' => 'Análisis no encontrado'], 404);
        }

        $request->validate([
            'id_consulta'   => 'sometimes|exists:consultas,id_consulta',
            'tipo'          => 'sometimes|required|string|max:100',
            'resultado'     => 'sometimes|nullable|string',
            'observaciones' => 'sometimes|nullable|string',
            'fecha'         => 'sometimes|nullable|date',
        ]);

        $analisis->fill($request->only([
            'id_consulta','tipo','resultado','observaciones','fecha'
        ]));
        $analisis->save();

        $analisis->load([
            'consulta.cita.pacienteUsuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.cita.medico.especialidad:id_especialidad,nombre',
            'consulta.medicoUser:id_usuario,nombre,apellido_paterno,apellido_materno,email',
            'consulta.paciente.usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email',
        ]);

        return response()->json($analisis, 200);
    }

    // DELETE /api/analisis-laboratorio/{id}
    public function destroy($id)
    {
        $analisis = AnalisisLaboratorio::find($id);
        if (!$analisis) {
            return response()->json(['mensaje' => 'Análisis no encontrado'], 404);
        }

        $analisis->delete();
        return response()->json(['mensaje' => 'Análisis eliminado'], 200);
    }
}
