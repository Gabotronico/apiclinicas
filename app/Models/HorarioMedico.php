<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMedico extends Model
{
    use HasFactory;

    protected $table = 'horario_medicos';
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_medico',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'estado'
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }
}
