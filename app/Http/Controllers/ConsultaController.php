<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\AnalisisLaboratorio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ConsultaController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $consultas = Consulta::with([
                'cita.usuario', // paciente de la cita
                'cita.medico.usuario', // médico de la cita
                'medicoUser', // médico de la consulta
                'paciente.usuario', // datos del paciente
                'analisis'
            ])->get();

            return response()->json($consultas);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las consultas',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'id_cita' => 'required|exists:citas,id_cita',
                'id_usuario' => 'required|exists:usuarios,id_usuario', // médico
                'id_paciente' => 'required|exists:pacientes,id_paciente',
                'motivo' => 'nullable|string|max:255',
                'diagnostico' => 'nullable|string|max:255',
                'tratamiento' => 'nullable|string',
                'indicaciones' => 'nullable|string',
                'proxima_cita' => 'nullable|date',
                'analisis' => 'nullable|array',
                'analisis.*.tipo' => 'required_with:analisis|string|max:100',
                'analisis.*.resultado' => 'nullable|string',
                'analisis.*.observaciones' => 'nullable|string',
                'analisis.*.fecha' => 'nullable|date',
            ]);

            // Crear la consulta
            $analisisData = $validatedData['analisis'] ?? [];
            unset($validatedData['analisis']);
            
            $validatedData['fecha_registro'] = now();
            $consulta = Consulta::create($validatedData);

            // Crear los análisis asociados si existen
            if (!empty($analisisData)) {
                foreach ($analisisData as $analisis) {
                    $analisis['id_consulta'] = $consulta->id_consulta;
                    AnalisisLaboratorio::create($analisis);
                }
            }

            // Cargar las relaciones para la respuesta
            $consulta->load([
                'cita.usuario',
                'cita.medico.usuario',
                'medicoUser',
                'paciente.usuario',
                'analisis'
            ]);

            return response()->json($consulta, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear la consulta',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $consulta = Consulta::with([
                'cita.usuario',
                'cita.medico.usuario',
                'medicoUser',
                'paciente.usuario',
                'analisis'
            ])->findOrFail($id);

            return response()->json($consulta);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Consulta no encontrada',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $consulta = Consulta::findOrFail($id);

            $validatedData = $request->validate([
                'id_cita' => 'sometimes|exists:citas,id_cita',
                'id_usuario' => 'sometimes|exists:usuarios,id_usuario',
                'id_paciente' => 'sometimes|exists:pacientes,id_paciente',
                'motivo' => 'nullable|string|max:255',
                'diagnostico' => 'nullable|string|max:255',
                'tratamiento' => 'nullable|string',
                'indicaciones' => 'nullable|string',
                'proxima_cita' => 'nullable|date',
                'analisis' => 'nullable|array',
                'analisis.*.id_analisis' => 'nullable|exists:analisislaboratorio,id_analisis',
                'analisis.*.tipo' => 'required_with:analisis|string|max:100',
                'analisis.*.resultado' => 'nullable|string',
                'analisis.*.observaciones' => 'nullable|string',
                'analisis.*.fecha' => 'nullable|date',
            ]);

            // Actualizar la consulta
            $analisisData = $validatedData['analisis'] ?? [];
            unset($validatedData['analisis']);
            
            $consulta->update($validatedData);

            // Manejar análisis
            if (isset($request->analisis)) {
                // Si se enviaron análisis, actualizarlos
                $existingAnalisisIds = [];
                
                foreach ($analisisData as $analisis) {
                    if (isset($analisis['id_analisis'])) {
                        // Actualizar análisis existente
                        $analisisExistente = AnalisisLaboratorio::find($analisis['id_analisis']);
                        if ($analisisExistente && $analisisExistente->id_consulta == $consulta->id_consulta) {
                            $analisisExistente->update($analisis);
                            $existingAnalisisIds[] = $analisis['id_analisis'];
                        }
                    } else {
                        // Crear nuevo análisis
                        $analisis['id_consulta'] = $consulta->id_consulta;
                        $nuevoAnalisis = AnalisisLaboratorio::create($analisis);
                        $existingAnalisisIds[] = $nuevoAnalisis->id_analisis;
                    }
                }

                // Eliminar análisis que no están en la lista actualizada
                AnalisisLaboratorio::where('id_consulta', $consulta->id_consulta)
                    ->whereNotIn('id_analisis', $existingAnalisisIds)
                    ->delete();
            }

            // Cargar las relaciones para la respuesta
            $consulta->load([
                'cita.usuario',
                'cita.medico.usuario',
                'medicoUser',
                'paciente.usuario',
                'analisis'
            ]);

            return response()->json($consulta);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar la consulta',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $consulta = Consulta::findOrFail($id);
            
            // Los análisis se eliminarán automáticamente por la foreign key con cascade
            $consulta->delete();

            return response()->json(['message' => 'Consulta eliminada exitosamente']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar la consulta',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Método específico para obtener consultas por cita
    public function getByCity($citaId): JsonResponse
    {
        try {
            $consultas = Consulta::with([
                'cita.usuario',
                'cita.medico.usuario',
                'medicoUser',
                'paciente.usuario',
                'analisis'
            ])->where('id_cita', $citaId)->get();

            return response()->json($consultas);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener las consultas de la cita',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
