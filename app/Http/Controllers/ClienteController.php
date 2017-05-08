<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EllipseSynergie\ApiResponse\Contracts\Response;
use App\Cliente;
class ClienteController extends Controller
{

    protected $response;

    public function __construct(Response $response)
    {
        // $this->middleware('auth');
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('clientes.index',compact('clientes'));
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
    public function update(Request $request,$cliente)
    {
        $cliente = Cliente::find($cliente);
        $cliente->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /*APIRest*/

    public function indexAPI()
    {
        try {
            $response = [
               'clientes' => []
            ];

            $statusCode = 200;
            $clientes = Cliente::all();

            foreach ($clientes as $cliente) {
                $response['clientes'][] = [
                    'id'        =>  $cliente->id,
                    'nombre'    =>  $cliente->nombre,
                    'apellido'  =>  $cliente->apellido,
                    'doc'       =>  $cliente->doc,
                    'telefono'  =>  $cliente->telefono,
                    'correo'    =>  $cliente->correo
                ];
            }
        } catch (Exception $e) {
            $statusCode = 404;   
        }finally{
            return response()->json($response,$statusCode);
        }
    }
}
