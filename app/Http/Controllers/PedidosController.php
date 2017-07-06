<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Cliente;
use App\Articulo;
use App\DetallePedido;

class PedidosController extends Controller
{

    public function index()
    {
        return view('pedidos.index');
    }

    public function pedidos()
    {
        
        $pedidos = Pedidos::orderBy('created_at','desc')
                            ->paginate(10);

        return response()->json($pedidos);
    }

    public function clientes()
    {
        $clientes = Cliente::all();

        return response()->json($clientes);
    }


    public function articulos()
    {
        $articulos = Articulo::all();

        return response()->json($articulos);
    }

    public function new()
    {
        return view('pedidos.new');   
    }

    public function store(Request $request)
    {

        $pedido = new Pedido;

        $pedido->id_cliente = $request->id_cliente; 
        $pedido->costo_total = $request->costo_total; 

        $pedido->save();

        $detalles = $request->detalles;
        
        foreach ($detalles as $detalle) {

            $articulo = new DetallePedido;

            $articulo->id_pedido = $pedido->id;
            $articulo->sub_total = $detalle['precio'];
            $articulo->total = $detalle['precio'];
            $articulo->id_articulo = $detalle['id'];
            $articulo->descripcion = $detalle['descripcion'];
            $articulo->cantidad = $detalle['cantidad'];

            $articulo->save();
        }


        return response()->json($pedido->id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
