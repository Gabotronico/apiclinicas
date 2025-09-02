<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\EspecialidadController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AnalisisLaboratorioController;
use App\Http\Controllers\Api\HorarioMedicoController;
use App\Http\Controllers\Api\DashboardController;

// Rutas API

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/stats', [DashboardController::class, 'stats']);
    Route::get('/system-status', [DashboardController::class, 'systemStatus']);
    Route::get('/citas-stats', [DashboardController::class, 'citasStats']);
    Route::get('/consultas-stats', [DashboardController::class, 'consultasStats']);
    Route::get('/citas-por-fecha', [DashboardController::class, 'citasPorFecha']);
    Route::get('/top-especialidades', [DashboardController::class, 'topEspecialidades']);
});

// Roles
Route::apiResource('roles', RolController::class);

// Usuarios
Route::apiResource('usuarios', UsuarioController::class);
Route::get('usuarios/pacientes/list', [UsuarioController::class, 'getPacientes']);

// Pacientes
Route::apiResource('pacientes', PacienteController::class);

// Especialidades
Route::apiResource('especialidades', EspecialidadController::class);

// Médicos
Route::apiResource('medicos', MedicoController::class);

// Citas
Route::apiResource('citas', CitaController::class);

// Consultas
Route::apiResource('consultas', ConsultaController::class);
Route::get('consultas/cita/{citaId}', [ConsultaController::class, 'getByCity']);

// Análisis de Laboratorio
Route::apiResource('analisislaboratorio', AnalisisLaboratorioController::class);
Route::get('analisislaboratorio/consulta/{consultaId}', [AnalisisLaboratorioController::class, 'getByConsulta']);

// Horarios Médicos
Route::apiResource('horariosmedicos', HorarioMedicoController::class);
