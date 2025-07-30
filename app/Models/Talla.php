<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talla extends Model
{
    protected $table = 'tallas';
    protected $primaryKey = 'IdTalla';
    protected $fillable = ['NombreTalla'];

    // Relación: una talla puede tener muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'IdTalla', 'IdTalla');
    }
}
