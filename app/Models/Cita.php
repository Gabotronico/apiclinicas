<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $timestamps = true; // la migración usa $table->timestamps()

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
        // NO incluyas created_at / updated_at aquí
    ];

    // Paciente (usuario que reserva) - alias usado por el controlador
    public function pacienteUsuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Si también quieres mantener el nombre corto:
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    // Médico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico', 'id_medico');
    }

    // Consulta asociada
    public function consulta()
    {
        return $this->hasOne(Consulta::class, 'id_cita', 'id_cita');
    }
}
