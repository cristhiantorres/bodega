<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('articulos.index');
    }

    public function articulos()
    {
        $articulos = Articulo::join('tipo_articulos','tipo_articulo','=','tipo_articulos.id')
                              ->select('articulos.*','tipo_articulos.descripcion as tipo')
                              ->paginate(10);
        // $articulos = Articulo::find(2)->tipoArticulo;
        return response()->json($articulos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $articulo = new Articulo();
        $articulo->tipo_articulo = $request->tipo_articulo;
        $articulo->precio = $request->precio;
        $articulo->descripcion = $request->descripcion;
        $articulo->creado_por = $user->name;
        $articulo->save();

        $final = Articulo::find($articulo->id)
                              ->join('tipo_articulos','tipo_articulo','=','tipo_articulos.id')
                              ->select('articulos.*','tipo_articulos.descripcion as tipo')
                              ->paginate(10);

        return response()->json($final);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Articulo $articulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articulo $articulo)
    {
        //
    }
}
