<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\compras_detalle;

class ComprasDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //hacemos referencia al nombre de la tabla
        $compras_detalle = DB::table('compras_detalle')
        
        ->get();
        
        return $compras_detalle;
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
        $compras_detalle= new compras_detalle;
        
        $compras_detalle->compra_id = $request->compra_id;
        
        $compras_detalle->producto_id = $request->producto_id;
        
        $compras_detalle->costo_unitario = $request->costo_unitario;        
        
        $compras_detalle->cantidad = $request->cantidad;
        
        $compras_detalle->sub_total = $request->sub_total;
        
        
        $resultado = $compras_detalle->save();
        
        if($resultado)
        {
            
            return $compras_detalle;
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
        return compras_detalle::where('id', $id)->first();
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
        $valorDeIdCompra = $request->compra_id;
        $valorDeIdProducto = $request->producto_id;
        $valorDeCostoUnitario = $request->costo_unitario;
        $valorDeCantidad = $request->cantidad;
        $valorDeSubTotal = $request->subtotal;
        

        $compras_detalle = compras_detalle::find($id);

        $compras_detalle->compra_id = $valorDeIdCompra;
        $compras_detalle->producto_id = $valorDeIdProducto;
        $compras_detalle->costo_unitario = $valorDeCostoUnitario;
        $compras_detalle->cantidad = $valorDeCantidad;
        $compras_detalle->subtotal = $valorDeSubTotal;

        $resultado = $compras_detalle->save();
        if($resultado)
        {
            //exito
            return $compras_detalle;
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
        $compras_detalle = compras_detalle::find($id);
        //eliminamos el registro
        $compras_detalle->delete();
        //respuesta
        return 'Registro eliminado correctamente';
    }
}
