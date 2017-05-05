<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
   protected $fillable = 
   [
   		'id_pedido', 'precio', 'descripcion', 'cantidad',
   ];


   public function pedido()
   {
   		return $this->belongsTo('App\Pedido');
   }
}
