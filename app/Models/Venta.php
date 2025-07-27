<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'venta';
    protected $primaryKey = 'IdVenta';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'IdUsuario',
        'TipoVenta',
        'Fecha',
        'Total',
        'IdMetodoPago',
        'EstadoPedido',
        'IdDireccion',
        'IdRepartidor'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'IdUsuario', 'IdUsuario');
    }
}
