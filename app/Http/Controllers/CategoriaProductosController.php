<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cat_productos;

use Illuminate\Support\Facades\DB;

class CategoriaProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //hacemos referencia al nombre de la tabla
        $cat_productos = DB::table('cat_productos')

        ->get();
        
        return $cat_productos;
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
        $cat_productos= new cat_productos;
        
        $cat_productos->nombre = $request->nombre;
        
        $cat_productos->usa_stock = $request->usa_stock;
        
        $resultado = $cat_productos->save();
        
        if($resultado)
        {
    
            return $cat_productos;
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
        return cat_productos::where('id', $id)->first();
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
        $valorDeNombreEditar = $request->nombre;
        //obtengo el registro a editar por ID
        $categoria = cat_productos::find($id);
        //actualizo los campos del modelo
        $categoria->nombre = $valorDeNombreEditar;
        //guardo los cambios hechos en el modelo, los cuales se reflejan en la BD
        $resultado = $categoria->save();
        if($resultado)
        {
            //exito
            return $categoria;
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
        $categoria = cat_productos::find($id);
        //eliminamos el registro
        $categoria->delete();
        //respuesta
        return 'Registro eliminado correctamente';
    }
}
