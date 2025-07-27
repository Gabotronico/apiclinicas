<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'IdProducto';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'NombreProducto',
        'Precio',
        'IdCategoria',
        'Stock',
        'Imagen',
        'Archivo_RA'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'IdCategoria', 'IdCategoria');
    }
}
