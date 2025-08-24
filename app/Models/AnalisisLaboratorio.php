<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisLaboratorio extends Model
{
    use HasFactory;

    protected $table = 'analisislaboratorio';
    protected $primaryKey = 'id_analisis';
    public $timestamps = false;

    protected $fillable = [
        'id_consulta',
        'tipo',
        'resultado',
        'observaciones',
        'fecha',
    ];

   public function consulta()
{
    return $this->belongsTo(Consulta::class, 'id_consulta', 'id_consulta');
}
}
