<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    protected $fillable = [
        'nombre',
        'categorias_id',
        'descripcion',
        'precio',
        'foto',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categorias_id'); 
    }
}
