<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'IdProducto';
    protected $fillable = [
        'NombreProducto',
        'Precio',
        'IdCategoria',
        'Stock',
        'IdTalla',
        'IdColor',
        'IdImagen',
        'Archivo_RA'
    ];

    // Relaciones UNO A UNO (cada producto tiene UNA talla, UN color y UNA imagen principal)
    public function talla()
    {
        return $this->belongsTo(Talla::class, 'IdTalla', 'IdTalla');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'IdColor', 'IdColor');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'IdImagen', 'IdImagen');
    }
}
