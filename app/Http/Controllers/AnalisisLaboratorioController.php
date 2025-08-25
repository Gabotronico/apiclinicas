<?php

namespace App\Http\Controllers;

use App\Models\AnalisisLaboratorio;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AnalisisLaboratorioController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $analisis = AnalisisLaboratorio::with('consulta')->get();
            return response()->json($analisis);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los análisis',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'id_consulta' => 'required|exists:consultas,id_consulta',
                'tipo' => 'required|string|max:100',
                'resultado' => 'nullable|string',
                'observaciones' => 'nullable|string',
                'fecha' => 'nullable|date',
            ]);

            $analisis = AnalisisLaboratorio::create($validatedData);
            $analisis->load('consulta');

            return response()->json($analisis, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al crear el análisis',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $analisis = AnalisisLaboratorio::with('consulta')->findOrFail($id);
            return response()->json($analisis);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Análisis no encontrado',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $analisis = AnalisisLaboratorio::findOrFail($id);

            $validatedData = $request->validate([
                'id_consulta' => 'sometimes|exists:consultas,id_consulta',
                'tipo' => 'sometimes|string|max:100',
                'resultado' => 'nullable|string',
                'observaciones' => 'nullable|string',
                'fecha' => 'nullable|date',
            ]);

            $analisis->update($validatedData);
            $analisis->load('consulta');

            return response()->json($analisis);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al actualizar el análisis',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $analisis = AnalisisLaboratorio::findOrFail($id);
            $analisis->delete();

            return response()->json(['message' => 'Análisis eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar el análisis',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Método para obtener análisis por consulta
    public function getByConsulta($consultaId): JsonResponse
    {
        try {
            $analisis = AnalisisLaboratorio::where('id_consulta', $consultaId)->get();
            return response()->json($analisis);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los análisis de la consulta',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
