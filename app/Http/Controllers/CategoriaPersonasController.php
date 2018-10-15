<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\cat_personas;

class CategoriaPersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //hacemos referencia al nombre de la tabla
        $cat_personas = DB::table('cat_personas')
        
        ->get();
        
        return $cat_personas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cat_personas= new cat_personas;
        
        $cat_personas->per_id = $request->per_id;
        
        $cat_personas->cat_id = $request->cat_id;
        
        $resultado = $cat_personas->save();
        
        if($resultado)
        {
            
            return $cat_personas;
        }
        else
            return 'Ocurrio un error';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return cat_personas::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //PUT http://URL/api/categoria/{int}
        //$id es el ID que enviamos en el URL
        //en request vienen los datos de la solicitud, incluido el JSOn que enviamos en
        //el BODY de nuestra solicitud del postman
        $valorDeIdPersona = $request->per_id;
        $valorDeIdCategoria = $request->cat_id;
        //obtengo el registro a editar por ID
        $cat_personas = cat_personas::find($id);
        //actualizo los campos del modelo
        $cat_personas->per_id = $valorDeIdPersona;
        $cat_personas->cat_id = $valorDeIdCategoria;
        //guardo los cambios hechos en el modelo, los cuales se reflejan en la BD
        $resultado = $cat_personas->save();
        if($resultado)
        {
            //exito
            return $cat_personas;
        }
        else
        {
            //error
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat_personas = cat_personas::find($id);
        //eliminamos el registro
        $cat_personas->delete();
        //respuesta
        return 'Registro eliminado correctamente';
    }
}
