<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodopago';
    protected $primaryKey = 'IdMetodoPago';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'NombreMetodo',
        'Descripcion'
    ];
}
