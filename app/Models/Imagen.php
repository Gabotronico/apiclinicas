<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $primaryKey = 'IdImagen';
    protected $fillable = ['UrlImagen'];

    // Relación: una imagen puede estar asociada a muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'IdImagen', 'IdImagen');
    }
}
