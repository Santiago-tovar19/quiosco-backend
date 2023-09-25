<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use Carbon\Carbon;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\PedidoProducto;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PedidoCollection(Pedido::with("user")
        ->with("productos")
        ->where("estado",0)
        ->get()
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {

        //almacenar una order

        $pedido = new Pedido();
        $pedido->user_id = Auth::user()->id;
        $pedido->total = $request->total;
        $pedido->save();

        //obtener el id del pedido
        $id = $pedido->id;
        //obtener los producTOs del carrito

        $productos = $request->productos;

        //formatear el arreglo

        $pedido_productos = [];

        foreach ($productos as $producto) {
            $pedido_productos[] = [
                "pedido_id" => $id,
                "producto_id" => $producto["id"],
                "cantidad" => $producto["cantidad"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }

        //almacenar en las bases de datos

        //el insert a diferencia del save no guarda un objeto sino un arreglo

        PedidoProducto::insert($pedido_productos);
        return [
            "message" => "Pedido realizado correctamente estara listo en unos minutos",
            "productos" => $request->productos,

        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->estado = 1;
        $pedido->save();
        return [
            "pedido" => $pedido,
        ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {

    }
}
