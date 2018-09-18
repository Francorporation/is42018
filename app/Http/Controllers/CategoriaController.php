<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	//GET http://URL/api/categoria
    	//o http://URL/api/categoria?tipo=Ed con el parametro opcional
    	//capturamos el valor OPCIONAL del URL como get
    	//en este ejemplo el URL podria ser
    	//http://URL/api/categoria?tipo=Ed
    	//o si el parametro esta ausente
    	//http://URL/api/categoria
    	if ($request->has('tipo')) {
    		//si vino el parametro
    		$tipoParaBuscar = $request->input('tipo');
    	}
    	else 
    	{
    		//si no vino el parametro
    		$tipoParaBuscar = false;
    	}
    		
    	//hacemos referencia al nombre de la tabla
    	$categorias = DB::table('categoria')
    		//en caso el parametro $tipoParaBuscar NO sea falso se agrega el WHERE con el ILIKE
    		->when($tipoParaBuscar, function ($query) use ($tipoParaBuscar) {
    			return $query->where('tipo', 'ILIKE', '%' . $tipoParaBuscar . '%');
    	})
    	->get();
    		
    	return $categorias;
    		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //No utilizaremos este metodo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//POST http://URL/api/categoria
        //Crear un nuevo elemento
        //Metodo POST al URL api/categoria ejecuta este metodo
        //en $request tenemos los datos enviados por la solicitud del usuario
        $categoria = new Categoria;
        //Declaramos el nombre con el nombre enviado en el request, el parametro es tipo
        //este campo TIPO es el que definimos en el POSTMAN en el BODY  de la solicitud, es decir
        //el dato que el cliente enviaria
        //asigno este tipo del REQUEST/SOLICITUD al objeto de tipo CATEGORIA que creamos antes con el NEW
        $categoria->tipo = $request->tipo;
        //Guardamos el cambio en nuestro modelo
        $resultado = $categoria->save();
        //si resultado es TRUE se creo correctamente, sino error
        if($resultado)
        {
        	//retorno mi modelo, el framework actualizo los campos del modelo
        	//en forma acorde luego de guardar, incluyendo el ID autogenerado
        	return $categoria;
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
    	//GET http://URL/api/categoria/{int}
        //Obtener un elemento especifico por el ID
        //Este metodo se ejecuta con una solicitud de tipo GET
        //con el URL api/categoria/{id} el cual se recibe como parametro $id
        //el uso de first nos traera un solo registro el primero y unico en este caso
        //asi la respuesta NO sera un array
    	return Categoria::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //No utilizaremos este metodo
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
        $valorDeTipoEditar = $request->tipo;
        //obtengo el registro a editar por ID
        $categoria = Categoria::find($id);
		//actualizo los campos del modelo
		$categoria->tipo = $valorDeTipoEditar;
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
    	//DELETE http://URL/api/categoria/{int}
        //en ID tenemos el id que viene en el URL
        //cargamos en el modelo el registro con dicho ID
    	$categoria = Categoria::find($id);
    	//eliminamos el registro
    	$categoria->delete();
    	//respuesta
    	return 'Registro eliminado correctamente';
    }
}
