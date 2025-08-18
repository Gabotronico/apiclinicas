<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_medico',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'motivo',
        'observaciones',
        'consultorio',
        'created_at',
    ];

    // Relación con Usuario (paciente que reserva)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relación con Médico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }

    // Relación con Consulta
    public function consulta()
    {
        return $this->hasOne(Consulta::class, 'id_cita');
    }
}
