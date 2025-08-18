<?php

// App\Models\Medico.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $primaryKey = 'id_medico';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_especialidad',
        'telefono',
        'email',
    ];

    // Relaciones (opcional)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidad');
    }
}
