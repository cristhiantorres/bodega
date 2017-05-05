<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArticulo extends Model
{
    protected $fillable = [
    	'descripcion', 'creado_por'
    ];

    public function articulos()
    {
    	return $this->hasMany('App\Articulos');
    }
}
