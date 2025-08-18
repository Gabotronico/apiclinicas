<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

   protected $fillable = [
    'id_rol',
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'email',
    'password',
    'estado'
];


    // Relación: Un usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    // Relación: Un usuario puede ser un paciente
    public function paciente()
    {
        return $this->hasOne(Paciente::class, 'id_usuario');
    }

    // Relación: Un usuario puede ser un médico
    public function medico()
    {
        return $this->hasOne(Medico::class, 'id_usuario');
    }
}
