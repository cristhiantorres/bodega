<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Cliente;
class ClienteController extends Controller
{

    public function __construct(Response $response)
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->search);

        if ($search) {

            $clientes = Cliente::where('doc',$search)->get();

        }else{

            $clientes = Cliente::all();
        }

        return view('clientes.index',compact('clientes'))->withInput('search');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cliente $cliente)
    {
        $cliente->nombre    = $request->nombre;
        $cliente->apellido  = $request->apellido;
        $cliente->doc       = $request->doc;
        $cliente->telefono  = $request->telefono;
        $cliente->correo    = $request->correo;
        $cliente->direccion = $request->direccion;
        $cliente->update();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return back();
    }


    /*APIRest*/

    public function indexAPI()
    {
        try {
            $clientes = Cliente::all();
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

    

}
