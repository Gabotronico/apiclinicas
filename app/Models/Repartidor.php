<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    protected $table = 'repartidor';
    protected $primaryKey = 'IdRepartidor';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'Nombre',
        'Telefono',
        'IdVehiculo'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'IdVehiculo', 'IdVehiculo');
    }
}
