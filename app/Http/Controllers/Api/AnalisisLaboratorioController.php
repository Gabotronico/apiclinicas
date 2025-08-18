<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalisisLaboratorio;
use Illuminate\Http\Request;

class AnalisisLaboratorioController extends Controller
{
    // Mostrar todos los análisis
    public function index()
    {
        return response()->json(AnalisisLaboratorio::all(), 200);
    }

    // Registrar un nuevo análisis
    public function store(Request $request)
    {
        $request->validate([
            'id_consulta' => 'required|exists:consultas,id_consulta',
            'tipo' => 'required|string|max:100',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $analisis = AnalisisLaboratorio::create($request->all());

        return response()->json($analisis, 201);
    }

    // Mostrar un análisis específico
    public function show($id)
    {
        $analisis = AnalisisLaboratorio::find($id);

        if (!$analisis) {
            return response()->json(['mensaje' => 'Análisis no encontrado'], 404);
        }

        return response()->json($analisis, 200);
    }

    // Actualizar un análisis
    public function update(Request $request, $id)
    {
        $analisis = AnalisisLaboratorio::find($id);

        if (!$analisis) {
            return response()->json(['mensaje' => 'Análisis no encontrado'], 404);
        }

        $request->validate([
            'id_consulta' => 'required|exists:consultas,id_consulta',
            'tipo' => 'required|string|max:100',
            'resultado' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'fecha' => 'nullable|date',
        ]);

        $analisis->update($request->all());

        return response()->json($analisis, 200);
    }

    // Eliminar un análisis
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
