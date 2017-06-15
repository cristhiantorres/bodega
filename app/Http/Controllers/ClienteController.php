<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Cliente;
class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('clientes.index');
    }

    public function clientes()
    {
        try {

            $clientes = Cliente::orderBy('updated_at','DESC')
                                    ->simplePaginate(10);

        } catch (Exception $e) {

            $clientes = 404;

        }finally{

            return response()->json($clientes);

        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'    =>  'required',
            'apellido'  =>  'required',
            'doc'       =>  'required|unique:clientes',
            'telefono'  =>  'required',
            'correo'    =>  'required|email',
            'direccion' =>  'required',
            ]);

        $cliente = new Cliente;
        $cliente->nombre    = $request->nombre;
        $cliente->apellido  = $request->apellido;
        $cliente->doc       = $request->doc;
        $cliente->telefono  = $request->telefono;
        $cliente->correo    = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->save();

        return back();

    }

    public function update(Request $request,Cliente $cliente)
    {

        $cliente->nombre    = $request->nombre;
        $cliente->apellido  = $request->apellido;
        $cliente->doc       = $request->doc;
        $cliente->telefono  = $request->telefono;
        $cliente->correo    = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->update();

        return response()->json($cliente);

    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return back();
    }


    /*APIRest*/

    public function indexAPI()
    {
        try {

            $clientes = Cliente::orderBy('updated_at','DESC')
                                    ->simplePaginate(10);

        } catch (Exception $e) {

            $clientes = 404;

        }finally{

            return response()->json($clientes);

        }
    }

    public function showAPI($doc)
    {
        try {
            $cliente = Cliente::where('doc',$doc)->first();
            return response()->json($cliente,200);

        } catch (Exception $e) {

            return response()->json($e, 404);
        }
    }

    public function storeAPI(Request $request)
    {

        if ($request->isMethod("PUT")){

        }else if($request->isMethod("POST")){
            $message = '';

            $cliente = new Cliente;

            try {
                $cliente->nombre    = $request->nombre;
                $cliente->apellido  = $request->apellido;
                $cliente->doc       = $request->doc;
                $cliente->telefono  = $request->telefono;
                $cliente->correo    = $request->correo;
                $cliente->direccion = $request->direccion;

                $cliente->save();
                $respuesta[] = ["mensaje" => "Te has registrado satisfactoriamente"];
                return response()->json($respuesta);

            } catch (Exception $e) {
                $message = "Error: Favor intente mas tarde";
                $respuesta[] = ["mensaje" => $message];
                return response()->json($respuesta);
            }
        }

    }

    public function delete($id)
    {
        $cliente = Cliente::find($id);

        $cliente->delete();

        return response()->json($cliente);
    }



}
