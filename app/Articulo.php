<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
    	'tipo_articulo', 'descripcion', 'precio', 'creado_por',
    ];

    public function tipoArticulo()
    {
    	return $this->belongsTo('App\TipoArticulo');
    }
}
