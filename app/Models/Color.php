<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';
    protected $primaryKey = 'IdColor';
    protected $fillable = ['CodigoColor', 'NombreColor'];

    // Relación: un color puede tener muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'IdColor', 'IdColor');
    }
}
