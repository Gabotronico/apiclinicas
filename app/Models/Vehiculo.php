<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculo';
    protected $primaryKey = 'IdVehiculo';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'Placa',
        'Marca',
        'Modelo',
        'Tipo',
        'Año'
    ];
}
