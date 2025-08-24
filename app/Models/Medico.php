<?php

// App\Models\Medico.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $primaryKey = 'id_medico';
    public $timestamps = true;

    protected $fillable = ['id_usuario','id_especialidad','telefono'];

    // Eager loading por defecto (opcional)
    protected $with = ['usuario:id_usuario,nombre,apellido_paterno,apellido_materno,email', 'especialidad:id_especialidad,nombre'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad', 'id_especialidad');
    }

    // Útiles si luego filtras o listás
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_medico', 'id_medico');
    }

    public function horarios()
    {
        return $this->hasMany(HorarioMedico::class, 'id_medico', 'id_medico');
    }
}

