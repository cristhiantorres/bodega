<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
    	'id_cliente', 'costo_total', 'fecha_pedido',
    ];


    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }

    public function detalles()
    {
    	return $this->hasMany('App\DetallePedido');
    }
}
