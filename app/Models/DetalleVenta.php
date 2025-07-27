<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalleventa';
    protected $primaryKey = 'IdDetalleVenta';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'IdProducto',
        'IdVenta',
        'Cantidad',
        'PrecioUnitario',
        'SubTotal'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'IdVenta', 'IdVenta');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'IdProducto', 'IdProducto');
    }
}
