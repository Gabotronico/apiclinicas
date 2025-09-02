<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cita;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Especialidad;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Obtener estadísticas generales del dashboard
     */
    public function stats()
    {
        try {
            $totalUsuarios = Usuario::count();
            $totalCitas = Cita::count();
            $citasHoy = Cita::whereDate('fecha', Carbon::today())->count();
            $citasPendientes = Cita::where('estado', 'pendiente')->count();
            $totalConsultas = Consulta::count();
            $totalMedicos = Medico::count();
            $totalEspecialidades = Especialidad::count();
            $consultasHoy = Consulta::whereDate('fecha_registro', Carbon::today())->count();
            $citasConfirmadas = Cita::where('estado', 'confirmada')->count();
            $citasCanceladas = Cita::where('estado', 'cancelada')->count();
            $citasCompletadas = Cita::where('estado', 'completada')->count();
            $pacientesActivos = Paciente::count(); // Asumiendo que todos los pacientes están activos

            return response()->json([
                'success' => true,
                'data' => [
                    'totalUsuarios' => $totalUsuarios,
                    'totalCitas' => $totalCitas,
                    'citasHoy' => $citasHoy,
                    'citasPendientes' => $citasPendientes,
                    'totalConsultas' => $totalConsultas,
                    'totalMedicos' => $totalMedicos,
                    'totalEspecialidades' => $totalEspecialidades,
                    'consultasHoy' => $consultasHoy,
                    'citasConfirmadas' => $citasConfirmadas,
                    'citasCanceladas' => $citasCanceladas,
                    'citasCompletadas' => $citasCompletadas,
                    'pacientesActivos' => $pacientesActivos,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas del dashboard',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estado del sistema
     */
    public function systemStatus()
    {
        try {
            // Verificar estado de la base de datos
            $database = 'connected';
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                $database = 'disconnected';
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'api' => 'active',
                    'database' => $database,
                    'services' => 'operational'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al verificar estado del sistema',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de citas por estado
     */
    public function citasStats()
    {
        try {
            $confirmadas = Cita::where('estado', 'confirmada')->count();
            $pendientes = Cita::where('estado', 'pendiente')->count();
            $canceladas = Cita::where('estado', 'cancelada')->count();
            $completadas = Cita::where('estado', 'completada')->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'confirmadas' => $confirmadas,
                    'pendientes' => $pendientes,
                    'canceladas' => $canceladas,
                    'completadas' => $completadas,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas de citas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de consultas por período
     */
    public function consultasStats()
    {
        try {
            $hoy = Consulta::whereDate('fecha_registro', Carbon::today())->count();
            $esteMes = Consulta::whereMonth('fecha_registro', Carbon::now()->month)
                              ->whereYear('fecha_registro', Carbon::now()->year)
                              ->count();
            $esteAnio = Consulta::whereYear('fecha_registro', Carbon::now()->year)->count();
            $total = Consulta::count();

            return response()->json([
                'success' => true,
                'data' => [
                    'hoy' => $hoy,
                    'esteMes' => $esteMes,
                    'esteAnio' => $esteAnio,
                    'total' => $total,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas de consultas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de citas por fecha (últimos 7 días)
     */
    public function citasPorFecha()
    {
        try {
            $stats = [];
            for ($i = 6; $i >= 0; $i--) {
                $fecha = Carbon::today()->subDays($i);
                $count = Cita::whereDate('fecha', $fecha)->count();
                $stats[] = [
                    'fecha' => $fecha->format('Y-m-d'),
                    'dia' => $fecha->format('D'),
                    'count' => $count
                ];
            }

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener estadísticas por fecha',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener top especialidades más solicitadas
     */
    public function topEspecialidades()
    {
        try {
            $especialidades = DB::table('citas')
                ->join('medicos', 'citas.id_medico', '=', 'medicos.id_medico')
                ->join('especialidades', 'medicos.id_especialidad', '=', 'especialidades.id_especialidad')
                ->select('especialidades.nombre', DB::raw('count(*) as total'))
                ->groupBy('especialidades.id_especialidad', 'especialidades.nombre')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $especialidades
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener especialidades top',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
