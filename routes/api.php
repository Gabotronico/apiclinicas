<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RolController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\EspecialidadController;
use App\Http\Controllers\Api\MedicoController;
use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\ConsultaController;
use App\Http\Controllers\Api\AnalisisLaboratorioController;
use App\Http\Controllers\Api\HorarioMedicoController;

// Rutas API

// Roles
Route::apiResource('roles', RolController::class);

// Usuarios
Route::apiResource('usuarios', UsuarioController::class);

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

// Análisis de Laboratorio
Route::apiResource('analisislaboratorio', AnalisisLaboratorioController::class);

// Horarios Médicos
Route::apiResource('horariosmedicos', HorarioMedicoController::class);
