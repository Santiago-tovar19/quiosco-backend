<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Resources\ProductoCollection;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //  return new ProductoCollection(Producto::where("disponible",1)
    //  ->orderBy('id', 'desc')
    //  ->paginate(10)
    // );

    // return new ProductoCollection(Producto::all());

    return new ProductoCollection(Producto::where("disponible",1)
    ->orderBy("id","DESC")
    ->get());
    }

    public function view()
    {
        return "productos aqui...";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrearProductoRequest $request)
    {
        // $data = $request->validated();

        // $producto = [
        //     "nombre" => $data["nombre"],
        //     "precio" => $data["precio"],
        //     "categoria_id" => $data["categoria_id"],
        //     "imagen" => $data["imagen"],
        // ];

        return [
            "mensaje" => "Producto creado correctamente",
            "producto" => $request
        ];

    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->disponible = 0;
        $producto->save();
        return [
            "producto" => $producto
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
