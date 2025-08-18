<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';
    protected $primaryKey = 'id_paciente';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'ci',
        'fecha_nac',
        'sexo',
        'telefono',
        'email',
        'direccion',
        'created_at',
    ];

    // Relación: El paciente pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    // Relación: Un paciente puede tener muchas consultas
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'id_paciente');
    }

    // Relación: Un paciente puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_usuario', 'id_usuario');
    }
}
