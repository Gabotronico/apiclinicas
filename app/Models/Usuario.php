<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'IdUsuario';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'Nombre',
        'Email',
        'password',
        'IdRol',
        'FechaRegistro'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'IdRol', 'IdRol');
    }
}
