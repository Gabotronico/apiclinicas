<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    public $timestamps = false;

    protected $fillable = [
        'id_cita',
        'id_usuario',
        'id_paciente',
        'motivo',
        'diagnostico',
        'tratamiento',
        'indicaciones',
        'proxima_cita',
        'fecha_registro',
    ];

    // Relación con Cita
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    // Relación con Médico (usuario)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relación con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    // Relación con Análisis de Laboratorio
    public function analisis()
    {
        return $this->hasMany(AnalisisLaboratorio::class, 'id_consulta');
    }
}
