<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'platillos_id',
        'fecha_venta',
        'cantidad',
    ];

    public function platillo()
    {
        return $this->belongsTo(Platillo::class, 'platillos_id'); 
    }
}
