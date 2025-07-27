<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'IdDireccion';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'IdUsuario',
        'Direccion',
        'Ciudad',
        'Latitud',
        'Longitud',
        'Referencia'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'IdUsuario', 'IdUsuario');
    }
}
