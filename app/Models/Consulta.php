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
   // App\Models\Consulta.php
public function cita()       { return $this->belongsTo(Cita::class, 'id_cita', 'id_cita'); }
public function medicoUser() { return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario'); } // médico (usuario)
public function paciente()   { return $this->belongsTo(Paciente::class, 'id_paciente', 'id_paciente'); }
public function analisis()   { return $this->hasMany(AnalisisLaboratorio::class, 'id_consulta', 'id_consulta'); }

}
